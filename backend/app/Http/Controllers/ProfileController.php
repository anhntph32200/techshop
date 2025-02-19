<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    // Hiển thị hồ sơ người dùng
    public function show()
    {
        $user = Auth::user();
        return view('admin.pages.Profile.profile', compact('user'));
    }

    public function account()
    {
        $user = auth()->user(); // Lấy thông tin user đang đăng nhập
        return view('user.pages.profile', compact('user'));
    }

    public function edit()
    {
        $user = auth()->user();
        return view('user.pages.edit_profile', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
        ]);

        $user = auth()->user();
        $user->update($request->only('name', 'email', 'address', 'phone'));

        return redirect()->route('user.profile')->with('success', 'Cập nhật thành công!');
    }
}
