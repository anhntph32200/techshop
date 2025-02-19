<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderHistory;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function Dashboard(Request $request)
    {
        if ($request->start_date && $request->end_date) {
            $start_date = Carbon::parse($request->start_date)->startOfDay();
            $end_date = Carbon::parse($request->end_date)->endOfDay();
        } else {
            $start_date = Carbon::now()->startOfMonth();
            $end_date = Carbon::now()->endOfMonth();
        }

        //năm
        if ($request->years) {
            $years = $request->years;
        } else {
            $years = date('Y');
        }
        // dd($start_date,$end_date);

        $totalmoney = Order::where('payment_status', Order::DA_THANH_TOAN)
            ->whereBetween('orders.created_at', [$start_date, $end_date])
            ->sum('orders.money_total');

        $totalBoughtProduct = OrderDetail::sum('quantity');

        $donhangdahuy = Order::query()->where('status', Order::HUY_HANG)
            ->whereBetween('orders.created_at', [$start_date, $end_date])
            ->count();


        $donhangdangchoxuly = Order::query()->where('status', Order::CHO_XAC_NHA)
            ->whereBetween('orders.created_at', [$start_date, $end_date])
            ->count();

        $tongdonhang = Order::count();

        $phantramdahuy = number_format(($donhangdahuy / $tongdonhang) * 100, 2);

        $phantramdangchoxuly = number_format(($donhangdangchoxuly / $tongdonhang) * 100, 2);

        // dd($phantramdangchoxuly);
        $totalProduct = ProductVariant::sum('quantity');
        // dd($totalBoughtProduct);

        $top5LastestComment = Review::query()
            ->orderBy('id', 'desc')
            ->limit(5)
            ->get();
        // dd($top5LastestComment);

        $top5productbought = Product::with('variants.orderDetail')
            ->join('product_variants', 'products.id', '=', 'product_variants.product_id')
            ->join('order_details', 'product_variants.id', '=', 'order_details.productvariant_id')
            ->join('orders', 'order_details.order_id', '=', 'orders.id')
            ->select('products.id', 'products.name', 'products.image', 'orders.created_at', 'order_details.quantity')
            ->where('orders.payment_status', Order::DA_THANH_TOAN)
            ->whereBetween('orders.created_at', [$start_date, $end_date])
            ->get()
            // ->toRawSql();
            // dd($top5productbought);
            ->groupBy('name') // Nhóm các sản phẩm theo tên. Điều này đảm bảo rằng mỗi sản phẩm chỉ xuất hiện một lần trong kết quả.
            ->map(function ($group) {
                // Tính tổng số lượng của tất cả các đơn đặt hàng cho mỗi sản phẩm, tránh việc tính nhiều lần nếu có nhiều biến thể hoặc đơn hàng.
                $total = $group->sum('quantity');

                // Tính tồn kho cho mỗi sản phẩm
                // Kiểm tra xem productVariants có dữ liệu hay không
                $firstProduct = $group->first();
                $stock = 0; // Khởi tạo giá trị mặc định là 0

                // Kiểm tra nếu có productVariants
                if ($firstProduct && $firstProduct->variants) {
                    // Tính tổng số lượng tồn kho của sản phẩm dựa trên biến thể của nó.
                    $stock = $firstProduct->variants->sum('quantity');
                }

                // Lấy ngày mua hàng đầu tiên của sản phẩm
                // $purchaseDate = Carbon::parse($group->first()->created_at)->locale('vi')->isoFormat('D MMM YYYY');

                return [
                    'name' => $group->first()->name,
                    'image' => $group->first()->image,
                    'total' => $total,
                    'stock' => $stock,
                    // 'purchaseDate' => $purchaseDate,
                ];
            })
            ->sortByDesc('total')
            ->take(5); // Lấy 5 sản phẩm hàng đầu


        // dd($top5productbought);

        $top5Users = Order::select('orders.user_id', 'users.name', 'users.phone', 'users.address', 'users.email')
            ->selectRaw('SUM(order_details.quantity) as total')
            ->selectRaw('COUNT(order_details.productvariant_id) as SoLanMua')
            ->join('order_details', 'orders.id', '=', 'order_details.order_id') // Kết hợp bảng order_details
            ->join('users', 'users.id', '=', 'orders.user_id') // Kết hợp bảng users
            ->where('orders.payment_status', Order::DA_THANH_TOAN)
            ->whereBetween('orders.created_at', [$start_date, $end_date])
            ->groupBy('orders.user_id', 'users.name', 'users.phone', 'users.address', 'users.email') // Nhóm theo user_id và các trường của users
            ->orderBy('total', 'desc')
            ->take(5)
            ->get();
        // ->toRawSql();
        // dd($top5Users);

        // thống kê theo năm 
        $currentYear = Carbon::now()->year;
        $years = $request->input('years', $currentYear); // Lấy giá trị năm từ form hoặc năm hiện tại

        // Lấy dữ liệu doanh số hàng tháng trong năm được chọn
        $monthlySales = OrderDetail::selectRaw('MONTH(orders.created_at) as month, SUM(order_details.quantity) as total_sales')
            ->join('orders', 'orders.id', '=', 'order_details.order_id')
            ->where('orders.payment_status', Order::DA_THANH_TOAN)
            ->whereYear('orders.created_at', $years) // Lọc theo năm được chọn
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get();

        // Khởi tạo mảng doanh số cho 12 tháng, mặc định là 0
        $monthlySalesData = array_fill(0, 12, 0);

        // Lưu doanh số vào mảng theo tháng
        foreach ($monthlySales as $item) {
            $monthlySalesData[$item->month - 1] = $item->total_sales; // Lưu doanh số vào mảng theo tháng
        }
        // dd($monthlySales);

        // Thống kê biểu đồ tròn theo danh mục sản phẩm đã bán 
        // Thêm thời gian vào ngày kết thúc
        $PieChart = SubCategory::select('sub_categories.name', 'sub_categories.id', DB::raw('SUM(Order_details.quantity) as total'))
            ->join('products', 'sub_categories.id', '=', 'products.sub_category_id')
            ->join('product_variants', 'products.id', '=', 'product_variants.product_id')
            ->join('order_details', 'product_variants.id', '=', 'order_details.productvariant_id')
            ->join('orders', 'orders.id', '=', 'order_details.order_id')
            ->where('orders.payment_status', Order::DA_THANH_TOAN) // Điều kiện trạng thái từ order_histories
            ->whereBetween('orders.created_at', [$start_date, $end_date]) // Sử dụng thời gian đã điều chỉnh
            ->groupBy('sub_categories.name', 'sub_categories.id')
            ->orderBy('total', 'desc')
            ->get();

        $percentages = [];

        foreach ($PieChart as $PieCharts) {
            if ($totalBoughtProduct > 0) {
                $percen = ($PieCharts->total / $totalBoughtProduct) * 100;
            } else {
                $percen = 0; // Đề phòng chia cho 0
            }
            $percentages[] = [
                'name' => $PieCharts->name,
                'total' => $PieCharts->total,
                'percent' => $percen
            ];
        }

        // Kiểm tra nếu $percentages không có dữ liệu
        if (empty($percentages)) {
            $percentages[] = [
                'name' => 'No Data',
                'total' => 0,
                'percent' => 0
            ];
        }
        // dd($PieChart);
        // Lưu mảng tổng sản phẩm vào biến cho JavaScript
        $totalSales = array_column($percentages, 'percent'); // Lấy ra mảng tổng sản phẩm
        // dd($totalSales);
        return view('admin.pages.dashboard', compact(
            'start_date',
            'end_date',
            'totalmoney',
            'totalBoughtProduct',
            'donhangdahuy',
            'donhangdangchoxuly',
            'tongdonhang',
            'phantramdahuy',
            'phantramdangchoxuly',
            'totalProduct',
            'top5LastestComment',
            'top5productbought',
            'top5Users',
            'currentYear',
            'years',
            'monthlySales',
            'monthlySalesData',
            'percentages',
            'totalSales'
        ));
    }
}
