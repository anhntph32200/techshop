<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubcategoryRequest;
use App\Http\Requests\UpdateSubcategoryRequest;
use App\Models\Subcategory;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SubcategoryController extends Controller
{
    public function index()
    {
        $subcategories = Subcategory::with('category')->get();
        return view('admin.pages.subcategories.index', compact('subcategories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.pages.subcategories.create', compact('categories'));
    }

    public function store(StoreSubcategoryRequest $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'required|boolean',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Xử lý upload hình ảnh
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('subcategories', 'public');
        }

        Subcategory::create($validated);

        return redirect()->route('subcategories.index')->with('success', 'Thêm danh mục con thành công.');
    }

    public function edit(Subcategory $subcategory)
    {
        $categories = Category::all();
        return view('admin.pages.subcategories.edit', compact('subcategory', 'categories'));
    }

    public function update(UpdateSubcategoryRequest $request, Subcategory $subcategory)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'required|boolean',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Xử lý upload hình ảnh
        if ($request->hasFile('image')) {
            // Xóa hình ảnh cũ
            if ($subcategory->image) {
                Storage::disk('public')->delete($subcategory->image);
            }
            $validated['image'] = $request->file('image')->store('subcategories', 'public');
        }

        $subcategory->update($validated);

        return redirect()->route('subcategories.index')->with('success', 'Cập nhật danh mục con thành công.');
    }

    public function destroy(Subcategory $subcategory)
    {
        // Kiểm tra xem danh mục con có sản phẩm hay không
        if ($subcategory->products()->exists()) {
            return redirect()->back()->with('error', 'Không thể xóa danh mục này vì vẫn còn sản phẩm tồn tại.');
        }

        // Xóa hình ảnh nếu tồn tại
        if ($subcategory->image) {
            try {
                Storage::disk('public')->delete($subcategory->image);
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Lỗi khi xóa hình ảnh: ' . $e->getMessage());
            }
        }

        $subcategory->delete();

        return redirect()->route('subcategories.index')->with('success', 'Xóa danh mục con thành công.');
    }
}
