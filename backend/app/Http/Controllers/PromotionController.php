<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    // Hiển thị danh sách khuyến mãi
    public function index()
    {
        // Lấy tất cả khuyến mãi và phân trang
        $promotions = Promotion::paginate(10); // 10 khuyến mãi mỗi trang
        return view('admin.pages.promotions.index', compact('promotions'));
    }

    // Hiển thị form thêm mới khuyến mãi
    public function create()
    {
        return view('admin.pages.promotions.create');
    }

    // Xử lý việc thêm mới khuyến mãi
    public function store(Request $request)
    {
        // Validate dữ liệu
        $request->validate([
            'code' => 'required|unique:promotions,code',
            'discount' => 'required|numeric',
            'discount_type' => 'required|in:percentage,fixed',
            'minimum_spend' => 'nullable|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'usage_limit' => 'nullable|integer',
        ]);

        // Thêm khuyến mãi mới
        Promotion::create($request->all());

        return redirect()->route('promotions.index')->with('success', 'Khuyến mãi đã được thêm!');
    }

    // Hiển thị form chỉnh sửa khuyến mãi
    public function edit($id)
    {
        $promotion = Promotion::findOrFail($id);
        return view('admin.pages.promotions.edit', compact('promotion'));
    }

    // Xử lý việc cập nhật khuyến mãi
    public function update(Request $request, $id)
    {
        $promotion = Promotion::findOrFail($id);

        // Validate dữ liệu
        $request->validate([
            'code' => 'required|unique:promotions,code,' . $id,
            'discount' => 'required|numeric',
            'discount_type' => 'required|in:percentage,fixed',
            'minimum_spend' => 'nullable|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'usage_limit' => 'nullable|integer',
        ]);

        // Cập nhật khuyến mãi
        $promotion->update($request->all());

        return redirect()->route('promotions.index')->with('success', 'Khuyến mãi đã được cập nhật!');
    }

    // Xóa khuyến mãi
    public function destroy($id)
    {
        $promotion = Promotion::findOrFail($id);
        $promotion->delete();

        return redirect()->route('promotions.index')->with('success', 'Khuyến mãi đã được xóa!');
    }
}
