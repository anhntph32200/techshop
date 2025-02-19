<?php

namespace App\Http\Controllers;

use App\Models\CartDetail;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderHistory;
use App\Models\Promotion;
use App\Models\Shipping;
use App\Mail\OrderInvoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function checkout(Request $request)
    {
        $cart = Auth::user()->carts()->latest()->first();
        if (!$cart) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng của bạn trống.');
        }
        if ($request->input('promo_code')) {
            $promo_code = $request->input('promo_code');
            session(['promo_code' => $promo_code]);
        }
        if ($request->input('shipping_id')) {
            $shipping_id = $request->input('shipping_id');
            session(['shipping_id' => $shipping_id]);
        }

        $cartDetails = CartDetail::with(['productVariant.product'])->where('carts_id', $cart->id)->get();
        $totalPrice = $this->calculateTotalPrice($cartDetails);
        $shippingCost = $this->getShippingCost($request->input('shipping_id'));
        $discount = $this->calculateDiscount($request->input('promo_code'), $totalPrice);
        $finalTotal = $totalPrice + $shippingCost - $discount;
        $shippings = Shipping::all();
        $user = Auth::user();

        return view('user.pages.checkout', compact('cartDetails', 'totalPrice', 'shippingCost', 'discount', 'finalTotal', 'shippings', 'user'));
    }

    public function placeOrder(Request $request)
    {
        // Xác thực dữ liệu từ request
        $request->validate([
            'name' => 'required|string',
            'address' => 'required|string',
            'phone' => 'required|string',
            'note' => 'nullable|string',
            'payment_method' => 'required|string',
        ]);
        // Lấy giỏ hàng hiện tại của người dùng
        $cart = Auth::user()->carts()->latest()->first();
        if (!$cart) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng của bạn trống.');
        }

        // Lấy chi tiết giỏ hàng
        $cartDetails = CartDetail::with(['productVariant'])->where('carts_id', $cart->id)->get();

        // Bắt đầu transaction
        DB::beginTransaction();

        try {
            // Kiểm tra tồn kho cho từng sản phẩm trong giỏ hàng
            foreach ($cartDetails as $detail) {
                if ($detail->productVariant->quantity < $detail->quantity) {
                    DB::rollBack(); // Nếu số lượng không đủ, hoàn tác giao dịch
                    return redirect()->back()->with('error', 'Số lượng sản phẩm "' . $detail->productVariant->product->name . '" không đủ trong kho.');
                }
            }

            // Tính toán tổng giá trị đơn hàng
            $total_price = $cartDetails->sum(function ($detail) {
                return ($detail->productVariant->sale_price ?? $detail->productVariant->listed_price) * $detail->quantity;
            });

            // Lấy phí vận chuyển và tính toán mã giảm giá     
            if (session()->has('promo_code') || session()->has('shipping_id')) {
                $promo_code = session('promo_code');
                $shipping_id = session('shipping_id');

                $discount = $this->calculateDiscount($promo_code, $total_price);
                $shippingCost = $this->getShippingCost($shipping_id);
                session()->forget('promo_code');
                session()->forget('shipping_id');
            } else {
                $promo_code = null;
                $shipping_id = optional(Shipping::where('cost', $this->getShippingCost(null))->first())->id;
                $discount = $this->calculateDiscount(null, $total_price); // Không có mã giảm giá
                $shippingCost = $this->getShippingCost(null); // Không có phương thức vận chuyển
            }

            $finalTotal = $total_price + $shippingCost - $discount;
            // Tạo đơn hàng mới(chưa lưu)
            $order = new Order();
            $order->fill([
                'code' => uniqid(),
                'payment_type' => $request->payment_method,
                'total_price' => $total_price,
                'user_id' => Auth::id(),
                'name' => $request->name,
                'address' => $request->address,
                'note' => $request->note,
                'phone' => $request->phone,
                'promotion_id' => optional(Promotion::where('code', $promo_code)->first())->id,
                'shipping_id' => $shipping_id,
                'money_total' => $finalTotal,
            ]);

            // Xử lý thanh toán tương ứng với phương thức
            switch ($order->payment_type) {
                case 'cod':
                    // Nếu là COD lưu đơn hàng vào db
                    $order->save();
                    // Tạo chi tiết đơn hàng
                    foreach ($cartDetails as $detail) {
                        $productVariant = $detail->productVariant;
                        $orderDetail = new OrderDetail();
                        $orderDetail->fill([
                            'order_id' => $order->id,
                            'productvariant_id' => $productVariant->id,
                            'quantity' => $detail->quantity,
                            'listed_price' => $productVariant->listed_price,
                            'sale_price' => $productVariant->sale_price,
                            'name' => $productVariant->product->name,
                            'image' => $productVariant->product->image,
                        ]);
                        $orderDetail->save();
                    }
                    // Kiểm tra nếu người dùng có email và gửi hóa đơn
                    if (Auth::check() && Auth::user()->email) {
                        Mail::to(Auth::user()->email)->send(new OrderInvoice($order));
                    }
                    $this->updateStock($cartDetails);
                    DB::commit();
                    // Xóa giỏ hàng và chi tiết giỏ hàng
                    $cart->cartDetails()->delete();
                    $cart->delete();
                    return redirect()->route('order.detail', $order->id);

                case 'momo':
                    // Gọi phương thức thanh toán MoMo
                    $paymentResponse = $this->momo_payment($request, $order);

                    // Kiểm tra phản hồi
                    if ($paymentResponse['success']) {
                        $order->save();
                        // Tạo chi tiết đơn hàng
                        foreach ($cartDetails as $detail) {
                            $productVariant = $detail->productVariant;
                            $orderDetail = new OrderDetail();
                            $orderDetail->fill([
                                'order_id' => $order->id,
                                'productvariant_id' => $productVariant->id,
                                'quantity' => $detail->quantity,
                                'listed_price' => $productVariant->listed_price,
                                'sale_price' => $productVariant->sale_price,
                                'name' => $productVariant->product->name,
                                'image' => $productVariant->product->image,
                            ]);
                            $orderDetail->save();
                        }
                        // Kiểm tra nếu người dùng có email và gửi hóa đơn
                        if (Auth::check() && Auth::user()->email) {
                            Mail::to(Auth::user()->email)->send(new OrderInvoice($order));
                        }
                        $this->updateStock($cartDetails);
                        DB::commit();
                        // Xóa giỏ hàng và chi tiết giỏ hàng
                        $cart->cartDetails()->delete();
                        $cart->delete();
                        return redirect($paymentResponse['payUrl']);
                    } else {
                        DB::rollBack();
                        return redirect()->back()->with('error', 'Có lỗi xảy ra khi thanh toán MoMo: ' . $paymentResponse['message']);
                    }

                case 'vnpay':
                    // Trước tiên, lưu đơn hàng để lấy ID của đơn hàng
                    $order->save();

                    // Gọi phương thức thanh toán VNPAY
                    $paymentResponse = $this->vnpay_payment($request, $order);

                    // Kiểm tra phản hồi thanh toán
                    if ($paymentResponse['success']) {
                        // Cập nhật trạng thái thanh toán
                        $order->payment_status = 'da_thanh_toan';
                        $order->save();

                        // Tạo chi tiết đơn hàng
                        foreach ($cartDetails as $detail) {
                            $productVariant = $detail->productVariant;
                            $orderDetail = new OrderDetail();
                            $orderDetail->fill([
                                'order_id' => $order->id,
                                'productvariant_id' => $productVariant->id,
                                'quantity' => $detail->quantity,
                                'listed_price' => $productVariant->listed_price,
                                'sale_price' => $productVariant->sale_price,
                                'name' => $productVariant->product->name,
                                'image' => $productVariant->product->image,
                            ]);
                            $orderDetail->save();
                        }

                        // Kiểm tra nếu người dùng có email và gửi hóa đơn
                        if (Auth::check() && Auth::user()->email) {
                            Mail::to(Auth::user()->email)->send(new OrderInvoice($order));
                        }

                        // Cập nhật kho
                        $this->updateStock($cartDetails);

                        // Commit giao dịch
                        DB::commit();

                        // Xóa giỏ hàng và chi tiết giỏ hàng
                        $cart->cartDetails()->delete();
                        $cart->delete();

                        // Chuyển hướng đến URL thanh toán VNPAY
                        return redirect($paymentResponse['payUrl']);
                    } else {
                        // Rollback giao dịch nếu có lỗi
                        DB::rollBack();
                        return redirect()->back()->with('error', 'Có lỗi xảy ra khi thanh toán VNPAY: ' . $paymentResponse['message']);
                    }


                default:
                    DB::rollBack();
                    return redirect()->route('order.detail', $order->id)->with('error', 'Phương thức thanh toán không hợp lệ.');
            }

            // Trả về thông tin chi tiết đơn hàng sau khi đã hoàn tất
            return redirect()->route('order.detail', $order->id);
        } catch (\Exception $e) {
            // Nếu có lỗi, hoàn tác giao dịch
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại!');
        }
    }

    protected function updateStock($cartDetails)
    {
        // Giảm số lượng sản phẩm trong kho theo từng sản phẩm trong giỏ hàng
        foreach ($cartDetails as $detail) {
            $productVariant = $detail->productVariant;
            // Giảm số lượng của sản phẩm
            $productVariant->quantity -= $detail->quantity;
            $productVariant->save();
        }
    }

    private function getShippingCost($shippingId)
    {
        // Kiểm tra nếu $shippingId tồn tại và tìm theo ID, nếu không có thì trả về giá trị của dòng đầu tiên trong bảng Shipping
        $shipping = Shipping::find($shippingId);

        if ($shipping) {
            return $shipping->cost;
        } else {
            // Nếu không có shippingId, lấy giá trị của dòng đầu tiên trong bảng Shipping
            return Shipping::first()?->cost ?? 0;
        }
    }

    private function calculateDiscount($promoCode, $totalPrice)
    {
        if (!$promoCode) return 0;

        // Lấy thông tin khuyến mãi từ mã giảm giá
        $promotion = Promotion::where('code', $promoCode)
            ->where('status', '1') // Mã giảm giá phải còn hiệu lực
            ->whereDate('start_date', '<=', now()) // Phải trong thời gian áp dụng
            ->whereDate('end_date', '>=', now()) // Phải còn trong thời gian áp dụng
            ->where(function ($query) use ($totalPrice) {
                $query->where('minimum_spend', '<=', $totalPrice)->orWhereNull('minimum_spend');
            })
            ->first();

        // Kiểm tra nếu mã giảm giá không tồn tại hoặc không hợp lệ
        if (!$promotion) {
            session()->flash('error', 'Mã giảm giá không hợp lệ hoặc không thể sử dụng.');
            return 0; // Không áp dụng giảm giá nếu không có mã giảm giá hợp lệ
        }

        // Kiểm tra nếu số lượng mã giảm giá còn lại bằng 0
        if ($promotion->usage_limit <= 0) {
            session()->flash('error', 'Mã giảm giá đã hết số lượng.');
            return 0; // Mã giảm giá hết số lượng
        }

        // Kiểm tra nếu tổng giá trị đơn hàng không đạt yêu cầu chi tiêu tối thiểu
        if ($promotion->minimum_spend && $totalPrice < $promotion->minimum_spend) {
            session()->flash('error', 'Tổng giá trị đơn hàng không đủ để sử dụng mã giảm giá.');
            return 0; // Không đủ điều kiện chi tiêu tối thiểu
        }

        // Tính toán giảm giá dựa trên loại giảm giá
        $discount = $promotion->discount_type === 'percentage'
            ? $totalPrice * ($promotion->discount / 100)
            : $promotion->discount;

        $promotion->decrement('usage_limit');
        // Đảm bảo giảm giá không vượt quá tổng giá trị đơn hàng
        return min($discount, $totalPrice);
    }

    private function calculateTotalPrice($cartDetails)
    {
        return $cartDetails->sum(fn($detail) => ($detail->productVariant->sale_price ?? $detail->productVariant->listed_price) * $detail->quantity);
    }

    public function show($id)
    {
        // Lấy đơn hàng với các mối quan hệ cần thiết
        $order = Order::with([
            'orderDetails.productVariant.product',
            'shipping',
            'promotion',
        ])->find($id);

        // Kiểm tra nếu đơn hàng không tồn tại
        if (!$order) {
            return redirect()->route('orders.index')->with('error', 'Đơn hàng không tồn tại.');
        }

        // Trạng thái đơn hàng
        $orderStatus = Order::TRANG_THAI_DON_HANG[$order->status] ?? 'Không xác định';

        // Trạng thái thanh toán
        $paymentStatus = Order::TRANG_THAI_THANH_TOAN[$order->payment_status] ?? 'Không xác định';

        // Trả về view với thông tin đơn hàng và chi tiết
        return view('user.pages.order_detail', compact('order', 'orderStatus', 'paymentStatus'));
    }

    public function momo_payment(Request $request, $order)
    {
        // Lấy thông tin từ request
        $cardNumber = $request->input('card_number');
        $expiryDate = $request->input('expiry_date');
        $cvv = $request->input('cvv');

        // Các biến khác
        $endpoint = env('MOMO_ENDPOINT');
        $partnerCode = env('MOMO_PARTNER_CODE');
        $accessKey = env('MOMO_ACCESS_KEY');
        $secretKey = env('MOMO_SECRET_KEY');

        $orderInfo = "Thanh toán đơn hàng #" . $order->code;
        $amount = $order->total_price;
        $orderId = $order->code;
        $redirectUrl = route('order.detail', $order->id);
        $ipnUrl = route('order.ipn');
        $extraData = "";

        $requestId = time() . "";
        $requestType = "payWithATM";

        $rawHash = "accessKey=$accessKey&amount=$amount&extraData=$extraData&ipnUrl=$ipnUrl&orderId=$orderId&orderInfo=$orderInfo&partnerCode=$partnerCode&redirectUrl=$redirectUrl&requestId=$requestId&requestType=$requestType";
        $signature = hash_hmac("sha256", $rawHash, $secretKey);

        $data = [
            'partnerCode' => $partnerCode,
            'partnerName' => "Test",
            'storeId' => "MomoTestStore",
            'requestId' => $requestId,
            'amount' => (int)$amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature,
            'cardNumber' => $cardNumber,
            'expiryDate' => $expiryDate,
            'cvv' => $cvv,
        ];

        // Gửi yêu cầu và nhận phản hồi
        $result = $this->execPostRequest($endpoint, json_encode($data));
        $jsonResult = json_decode($result, true);

        // Ghi lại phản hồi để kiểm tra
        \Log::info('MoMo Response: ', $jsonResult);

        // Kiểm tra xem payUrl có tồn tại không
        if (isset($jsonResult['payUrl'])) {
            return [
                'success' => true,
                'payUrl' => $jsonResult['payUrl']
            ];
        } elseif (isset($jsonResult['message'])) {
            return ['success' => false, 'message' => 'Lỗi từ MoMo: ' . $jsonResult['message']];
        } else {
            return ['success' => false, 'message' => 'Có lỗi xảy ra khi xử lý thanh toán.'];
        }
    }

    public function vnpay_payment($request, $order)
    {
        // VNPAY Configuration
        $vnp_TmnCode = "7E31XY46";
        $vnp_HashSecret = "JO04I54AIVQB65LX3BDM4SQ95Y6JEZFH";
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route('order.detail', ['id' => $order->id]);
        $vnp_apiUrl = "http://sandbox.vnpayment.vn/merchant_webapi/merchant.html";
        $apiUrl = "https://sandbox.vnpayment.vn/merchant_webapi/api/transaction";

        // Prepare order information for VNPAY
        $vnp_TxnRef = $order->code;
        $vnp_OrderInfo = "Thanh toán đơn hàng #" . $order->code;
        $vnp_OrderType = "billpayment";
        $vnp_Amount = $order->total_price * 100; // Convert to VND x100
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'NCB'; // Replace with actual bank code if needed
        $vnp_IpAddr = $request->ip(); // Use $request object to get IP

        // Prepare input data for VNPAY
        $inputData = [
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        ];

        // If BankCode is set, add it to the inputData
        if (!empty($vnp_BankCode)) {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }

        // Log input data for debugging
        Log::info('VNPAY Payment Input Data:', $inputData);

        // Sort input data and create the query string for VNPAY
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        // Final VNPAY URL with query
        $vnp_Url .= "?" . rtrim($query, '&');

        // Generate VNPAY secure hash and append to the URL
        if (!empty($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
            $vnp_Url .= '&vnp_SecureHash=' . $vnpSecureHash;
        }

        // Prepare the response array
        $returnData = [
            'success' => true, // You can customize this based on the actual response
            'message' => 'Payment initiated successfully',
            'payUrl' => $vnp_Url,
        ];
        return $returnData; // Return the array, not a JsonResponse
    }

    public function vnpayReturn(Request $request)
    {
        $vnp_HashSecret = env('VNP_HASH_SECRET');
        $vnp_SecureHash = $request->vnp_SecureHash;
        $inputData = [];

        foreach ($request->all() as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }

        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $hashData = urldecode(http_build_query($inputData));
        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);

        if ($secureHash == $vnp_SecureHash) {
            $order = Order::where('code', $request->vnp_TxnRef)->first();
            if ($request->vnp_ResponseCode == '00') {
                $order->status = 'paid';
                $order->save();
                return redirect()->route('order.detail', $order->id);
            }
            $order->status = 'failed';
            $order->save();
        }

        return redirect()->route('order.detail', $order->id)->with('error', 'Thanh toán không thành công.');
    }

    public function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

        $result = curl_exec($ch);

        // Kiểm tra lỗi cURL
        if ($result === false) {
            $error = curl_error($ch);
            \Log::error("CURL Error: $error");
            return json_encode(['status' => 'error', 'message' => 'CURL request failed']);
        }

        curl_close($ch);
        return $result;
    }

    public function success($orderId)
    {
        $order = Order::find($orderId);

        if (!$order) {
            return redirect()->route('order.index')->with('error', 'Đơn hàng không tồn tại.');
        }

        return view('user.pages.order_detail', compact('order'));
    }

    public function ipn(Request $request)
    {
        // Tìm kiếm đơn hàng theo mã
        $order = Order::where('code', $request->orderId)->first();

        // Kiểm tra xem đơn hàng có tồn tại không
        if (!$order) {
            \Log::error('Đơn hàng không tồn tại cho mã: ' . $request->orderId);
            return response()->json(['status' => 'error', 'message' => 'Đơn hàng không tồn tại'], 404);
        }

        // Cập nhật trạng thái đơn hàng dựa trên kết quả
        if ($request->resultCode == 0) { // Nếu thanh toán thành công
            $order->status = 'paid';
        } else { // Nếu thanh toán thất bại
            $order->status = 'failed';
        }

        $order->save();

        return response()->json(['status' => 'success']);
    }
}
