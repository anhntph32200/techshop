<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class UserNewsController extends Controller
{
    // Hiển thị danh sách tin tức cho người dùng
    public function index()
    {
        $news = News::paginate(10);

        $recentPosts = News::latest()->take(5)->get();

        return view('user.pages.tins', compact('news', 'recentPosts'));
    }

    // Hiển thị chi tiết tin tức
    public function show($id)
    {
        $news = News::findOrFail($id);

        return view('user.pages.tins_detail', compact('news'));
    }
}
