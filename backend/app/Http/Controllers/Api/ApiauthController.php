<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Mail\forgotPasswordMail;
use App\Models\password_reset_tokens;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ApiauthController extends Controller
{
    public function postRegister(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hash mã hóa dữ liệu của pass
        ]);
        $token = $user->createToken('Access Token')->plainTextToken; // tạo ra token
        return response()->json([
            'token' => $token,
            'user' => $user,
            'message' => 'Đăng ký thành công',
        ]);
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'error' => 'sai email hoặc mật khẩu'
            ]);
        }
        $token = $user->createToken('access token')->plainTextToken;
        return response()->json([
            'token' => $token,
            'user' => $user,
            'message' => 'Đăng nhập thành công',
        ]);
    }

    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        $param = $request->except('_token', '_method');
        $check = $user->update($param);
        if ($check) {
            return response()->json([
                'message' => 'Cập nhật tài khoản thành công',
                'user' => $user,
            ], 200);
        } else {
            return response()->json([
                'message' => 'Cập nhật tài khoản không thành công',
                'user' => $user,
            ], 404);
        }
    }

    public function forgot_password()
    {
        /* trả về giao diện nhập email */
    }

    public function check_forgot_password(Request $request)
    {
        $email = $request->email;
        $user = User::where('email', $email)->first();
        if (!$user) {
            return response()->json([
                'message' => 'Email không tồn tại trong hệ thống'
            ], 404);
        }

        $token = Str::random(40);
        $tokendata = [
            'email' => $email,
            'token' => $token,
        ];

        if (password_reset_tokens::create($tokendata)) {
            Mail::to($email)->send(new forgotPasswordMail($user, $token));
            return response()->json([
                'message' => 'Vui lòng kiểm tra email',
                'token' => $token
            ]);
        } else {
            return response()->json([
                'message' => 'Chưa được gửi vào email'
            ]);
        }
    }

    public function reset_password($token)
    {
        $tokendata = password_reset_tokens::where('token', $token)->first();
        if (!$tokendata) {
            return response()->json([
                'message' => 'Token không hợp lệ hoặc đã hết hạn'
            ], 400);
        }

        return response()->json([
            'message' => 'Đã trả về trang gì đó',
            'token' => $tokendata
        ]);
    }

    public function check_reset_password(Request $request, $token)
    {

        $tokendata = password_reset_tokens::where('token', $token)->firstOrFail();


        $user = User::where('email', $tokendata->email)->first();

        if (!$user) {
            return response()->json([
                'message' => 'Người dùng không tồn tại'
            ], 404);
        }


        $user->update([
            'password' => Hash::make($request->password),
        ]);


        password_reset_tokens::where('email', $tokendata->email)->delete();

        return response()->json([
            'message' => 'Mật khẩu đã được cập nhật thành công'
        ]);
    }
}
