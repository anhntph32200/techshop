<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    // Hiển thị danh sách tin tức
    public function index()
    {
        $news = News::all();
        return view('admin.pages.news.index', compact('news'));
    }

    // Hiển thị form thêm tin tức
    public function create()
    {
        return view('admin.pages.news.create');
    }

    // Hiển thị chi tiết tin tức
    public function show($id)
    {
        $news = News::findOrFail($id);

        return view('user.pages.tins_detail', compact('news'));
    }

    // Xử lý lưu tin tức
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'author' => 'required',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
        ]);

        // Xử lý hình ảnh
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('news_images', 'public');
        }

        // Lưu tin tức vào cơ sở dữ liệu
        News::create([
            'title' => $request->title,
            'content' => $request->content,
            'author' => $request->author,
            'image' => $imagePath,
        ]);

        return redirect()->route('news.index')->with('success', 'Tin tức đã được thêm thành công');
    }


    // Hiển thị form sửa tin tức
    public function edit($id)
    {
        $news = News::findOrFail($id);
        return view('admin.pages.news.edit', compact('news'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'author' => 'required',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048', // Kiểm tra file hình ảnh
        ]);

        $news = News::findOrFail($id);

        // Xử lý hình ảnh nếu có
        $imagePath = $news->image;
        if ($request->hasFile('image')) {
            // Xóa hình ảnh cũ
            if ($imagePath && file_exists(storage_path('app/public/' . $imagePath))) {
                unlink(storage_path('app/public/' . $imagePath));
            }

            $imagePath = $request->file('image')->store('news_images', 'public');
        }

        // Cập nhật tin tức
        $news->update([
            'title' => $request->title,
            'content' => $request->content,
            'author' => $request->author,
            'image' => $imagePath,
        ]);

        return redirect()->route('news.index')->with('success', 'Tin tức đã được cập nhật');
    }


    // Xóa tin tức
    public function destroy($id)
    {
        $news = News::findOrFail($id);
        $news->delete();
        return redirect()->route('news.index')->with('success', 'Tin tức đã bị xóa');
    }
}
