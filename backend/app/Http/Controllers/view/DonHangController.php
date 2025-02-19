<?php

namespace App\Http\Controllers\view;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderHistory;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class DonHangController extends Controller
{
    //
    public function index(Request $request)
    {
        $query = Order::query();

        // Lọc theo khoảng thời gian (từ ngày - đến ngày)
        if ($request->has('from_date') && $request->has('to_date') && $request->from_date && $request->to_date) {            $query->whereBetween('created_at', [
                $request->from_date,
                $request->to_date,
            ]);
        }

        // Lọc theo trạng thái đơn hàng
        if ($request->has('filter_status') && $request->filter_status !== '' && $request->filter_status !== 'all') {
            $query->where('status', $request->filter_status);
        }

        // Tìm kiếm theo mã sản phẩm hoặc thông tin liên quan
        if ($request->has('search') && $request->search !== '') {
            $searchTerm = $request->search;
            $query->whereHas('orderDetails', function ($query) use ($searchTerm) {
                $query->where('code', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('name', 'LIKE', '%' . $searchTerm . '%');
            });
        }

        $listDonHang = $query->orderByDesc('id')->paginate(8);
        $trangThaiDonHang = Order::TRANG_THAI_DON_HANG;

        return view('admin.order.index', compact('listDonHang', 'trangThaiDonHang'));
    }

    public function show(string $id)
    {
        // Lấy đơn hàng với các mối quan hệ cần thiết
        $order = Order::with([
            'orderDetails.productVariant.product',
            'shipping',
            'promotion',
            'orderHistories.users' // Đảm bảo lấy thông tin người dùng thực hiện thay đổi trạng thái
        ])->find($id);

        // Kiểm tra nếu đơn hàng không tồn tại
        if (!$order) {
            return redirect()->route('orders.index')->with('error', 'Đơn hàng không tồn tại.');
        }

        // Lấy trạng thái đơn hàng
        $orderPayment = Order::TRANG_THAI_THANH_TOAN[$order->payment_status] ?? 'Không xác định';

        // Lấy các lịch sử trạng thái của đơn hàng, đã sắp xếp từ cũ đến mới
        $historyRecords = OrderHistory::where('order_id', $order->id)
            ->orderBy('created_at', 'asc')
            ->get();

        $historyRecords = $historyRecords->map(function ($history) {
            $fromStatus = Order::TRANG_THAI_DON_HANG[$history->from_status] ?? 'Không xác định';
            $toStatus = Order::TRANG_THAI_DON_HANG[$history->to_status] ?? 'Không xác định';

            // Thêm trạng thái hiển thị vào đối tượng lịch sử
            $history->from_status_display = $fromStatus;
            $history->to_status_display = $toStatus;

            return $history;
        });

        // Trả về view với thông tin đơn hàng, lịch sử và trạng thái
        return view('admin.order.show', compact('order', 'historyRecords', 'orderPayment'));
    }

    public function update(Request $request, string $id)
    {
        $donHang = Order::query()->findOrFail($id); // Lấy đơn hàng theo ID
        $currentTrangThai = $donHang->status; // Trạng thái hiện tại của đơn hàng
        $newTrangThai = $request->input('order_status'); // Trạng thái mới từ form
        $trangThais = array_keys(Order::TRANG_THAI_DON_HANG); // Mảng các trạng thái có thể có
    
        // Kiểm tra nếu đơn hàng đã bị hủy thì không được thay đổi trạng thái nữa
        if ($currentTrangThai == Order::HUY_HANG) {
            return redirect()->route('admins.orders.index')->with('error', 'Đơn hàng đã bị hủy, không thể thay đổi trạng thái.');
        }
    
        // Kiểm tra nếu trạng thái mới không được nằm sau trạng thái hiện tại
        if (array_search($newTrangThai, $trangThais) < array_search($currentTrangThai, $trangThais)) {
            return redirect()->route('admins.orders.index')->with('error', 'Không thể cập nhật ngược lại trạng thái.');
        }
    
        // Kiểm tra nếu trạng thái mới là "đã giao hàng", thì cập nhật trạng thái thanh toán thành "đã thanh toán"
        if ($newTrangThai == Order::DA_NHAN_HANG) {
            $donHang->payment_status = Order::DA_THANH_TOAN;  // Cập nhật trạng thái thanh toán
        }
    
        // Cập nhật trạng thái đơn hàng
        $donHang->status = $newTrangThai;
        $donHang->save();
    
        // Thêm lịch sử thay đổi trạng thái vào bảng order_histories
        OrderHistory::create([
            'order_id' => $donHang->id,
            'user_id' => auth()->id(), // Lấy ID người dùng hiện tại
            'from_status' => $currentTrangThai, // Trạng thái cũ
            'to_status' => $newTrangThai, // Trạng thái mới
            'note' => $request->input('note', ''), // Ghi chú (nếu có)
            'datetime' => now(), // Thời gian thực hiện
        ]);
    
        return redirect()->route('admins.orders.index')->with('success', 'Cập nhật trạng thái thành công: ' . $donHang->code);
    }
    

    public function generateInvoice($orderId)
    {
        $order = Order::with('items.product', 'user')->findOrFail($orderId);

        // Tạo PDF từ view
        $pdf = PDF::loadView('invoices.invoice', compact('order'));

        // Download hóa đơn PDF
        return $pdf->download('invoice_' . $order->id . '.pdf');
    }
}
