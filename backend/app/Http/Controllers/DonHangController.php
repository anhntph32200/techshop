<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DonHangController extends Controller
{
  //
  public function index(Request $request)
  {
    $user = Auth::user();
    if (!$user) {
      return redirect()->route('login'); // Chuyển hướng nếu người dùng chưa đăng nhập
    }

    // Truy vấn đơn hàng của người dùng
    $query = $user->order(); // Lấy tất cả đơn hàng của người dùng

    // Lọc theo trạng thái nếu có
    if ($request->has('filter_status') && $request->filter_status !== '' && $request->filter_status !== 'all') {
      $query->where('status', $request->filter_status); // Kiểm tra lại tên cột 'status'
    }

    // Sắp xếp theo ID và phân trang kết quả
    $donhang = $query->orderBy('id', 'desc')->paginate(5);

    // Trạng thái đơn hàng
    $TrangThaiDonHang = Order::TRANG_THAI_DON_HANG;
    $TrangThaiThanhToan = Order::TRANG_THAI_THANH_TOAN;
    $typeChoXacNha = Order::CHO_XAC_NHA;
    $typeDaXacNhan = Order::DA_XAC_NHA;
    $typeDangChuanBi = Order::DANG_CHUAN_BI;
    $typeDangVanChuyen = Order::DANG_VAN_CHUYEN;
    $typeDaNhanHang = Order::DA_NHAN_HANG;

    return view('user.order.Order', compact(
      'donhang',
      'TrangThaiDonHang',
      'TrangThaiThanhToan',
      'typeChoXacNha',
      'typeDaXacNhan',
      'typeDangChuanBi',
      'typeDangVanChuyen',
      'typeDaNhanHang'
    ));
  }


  public function editOrder(Request $request, $id)
  {
      $user = Auth::user();
      $order = $user->order()->find($id);
  
      if (!$order) {
          return redirect()->route('cart.myorder')->with('error', 'Đơn hàng không tồn tại.');
      }
  
      // Kiểm tra trạng thái và cập nhật
      $newStatus = $request->input('status');
      if ($newStatus) {
          // Nếu trạng thái mới là "hủy hàng", hủy đơn hàng
          if ($newStatus === 'huy_hang') {
              $order->update(['status' => 'huy_hang']);
              return redirect()->route('cart.myorder')->with('success', 'Hủy đơn hàng thành công.');
          }
  
          // Nếu trạng thái mới là "đã nhận hàng", cập nhật trạng thái đơn hàng
          if ($newStatus === 'da_nhan_hang') {
              $order->update(['status' => 'da_nhan_hang']);
              return redirect()->route('cart.myorder')->with('success', 'Cập nhật trạng thái thành công.');
          }
  
          // Nếu trạng thái mới là "đã giao hàng", cập nhật trạng thái đơn hàng và thanh toán
          if ($newStatus === 'da_giao_hang') {
              $order->update(['status' => 'da_giao_hang', 'payment_status' => 'da_thanh_toan']);
              return redirect()->route('cart.myorder')->with('success', 'Cập nhật trạng thái giao hàng thành công.');
          }
      }
  
      return redirect()->route('cart.myorder')->with('error', 'Không thể thay đổi trạng thái đơn hàng.');
  }
  

  public function myordetail(string $id) {}
}
