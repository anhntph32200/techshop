<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Hiển thị danh sách danh mục
    public function index()
    {
        // Lấy tất cả các danh mục
        $categories = Category::all();
        return view('admin.pages.categories.index', compact('categories'));
    }

    // Hiển thị form tạo danh mục
    public function create()
    {
        return view('admin.pages.categories.create');
    }

    // Lưu danh mục mới vào database
    public function store(StoreCategoryRequest $request)
    { 
        // Validate dữ liệu
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // Tạo mới danh mục
        Category::create($request->all());
        return redirect()->route('categories.index')->with('success', 'Thêm danh mục thành công.');
    }

    // Hiển thị form chỉnh sửa danh mục
    public function edit(Category $category)
    {
        return view('admin.pages.categories.edit', compact('category'));
    }

    // Cập nhật danh mục
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        // Validate dữ liệu
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // Cập nhật danh mục
        $category->update($request->all());
        return redirect()->route('categories.index')->with('success', 'Cập nhật danh mục thành công.');
    }

    // Xóa danh mục
    public function destroy(Category $category)
    {
        // Xóa danh mục
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Xóa danh mục thành công.');
    }
}
