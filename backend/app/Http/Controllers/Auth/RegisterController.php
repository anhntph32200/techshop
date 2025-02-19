<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.pages.register');
    }

    public function register(Request $request)
    {
        // Xác thực dữ liệu nhập vào
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:15|regex:/^[0-9]+$/', // Chỉ cho phép số
            'role' => 'required|in:admin,user',
        ]);

        // Kiểm tra và trả về thông báo lỗi nếu có
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Tạo người dùng mới với role được xác định
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'address' => $request->address ?? '',
                'phone' => $request->phone ?? '',
                'role' => $request->role,
            ]);
        } catch (\Exception $e) {
            // Ghi nhật ký lỗi và hiển thị thông báo lỗi cho người dùng
            Log::error('Error creating user: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Đã xảy ra lỗi trong quá trình tạo tài khoản.')->withInput();
        }

        // Chuyển hướng người dùng sau khi đăng ký thành công, dựa trên vai trò
        if ($user->role === 'admin') {
            return redirect()->route('admins')->with('success', 'Đăng ký thành công! Bạn đã đăng nhập.');
        } else {
            return redirect()->route('users.index')->with('success', 'Đăng ký thành công! Vui lòng đăng nhập.');
        }
    }
}
