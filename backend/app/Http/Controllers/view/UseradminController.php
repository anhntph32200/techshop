<?php

namespace App\Http\Controllers\view;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class UseradminController extends Controller
{
    public function update(Request $request)
    {
        // Kiểm tra dữ liệu yêu cầu
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'role' => 'required|in:admin,employee,user',
            'status' => 'required|in:0,1',
        ]);
    
        // Lấy thông tin người dùng cần cập nhật
        $user = User::findOrFail($request->input('user_id'));
    
        // Nếu trạng thái yêu cầu chuyển thành "Dừng" (status = 0)
        if ($request->input('status') == 0) {
            // Kiểm tra xem người dùng có đơn hàng đang xử lý không
            $hasActiveOrders = Order::where('user_id', $user->id)
                ->whereIn('status', ['da_nhan_hang', 'huy_hang']) // Thay đổi 'status' phù hợp với bảng Order
                ->exists();
    
            if ($hasActiveOrders) {
                return redirect()->route('admin.users')
                    ->with('error', 'Không thể dừng tài khoản vì người dùng có đơn hàng đang được xử lý.');
            }
        }
    
        // Cập nhật dữ liệu người dùng
        $user->role = $request->input('role');
        $user->status = $request->input('status');
        $user->save();
    
        // Quay lại trang danh sách người dùng với thông báo thành công
        return redirect()->route('admin.users')->with('success', 'Cập nhật tài khoản thành công tài khoản: ' . $user->name);
    }

    public function index()
    {
        // Lấy danh sách người dùng
        $users = User::all();
        return view('admin.pages.users.index', compact('users'));
    }
}


