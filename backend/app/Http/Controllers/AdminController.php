<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // Hiển thị trang dashboard admin
        return view('admins');
    }

    public function settings()
    {
        // Hiển thị trang cài đặt
        return view('admin.settings');
    }
}
