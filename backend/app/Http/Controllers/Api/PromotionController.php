<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
use Illuminate\Http\Request;

class PromotionController extends Controller
{

    public function applyPromotion(Request $request)
    {
        // Xác thực mã voucher
        $request->validate([
            'code' => 'required|string',
            'total' => 'required|numeric|min:0', // Tổng giá trị đơn hàng không thể nhỏ hơn 0
        ]);

        // Tìm mã promotion
        $promotion = Promotion::where('code', $request->code)->first();

        // Kiểm tra tính hợp lệ của promotion
        if (!$promotion || !$promotion->isValid()) {
            return response()->json(['error' => 'Mã giảm giá không hợp lệ hoặc đã hết hạn.'], 400);
        }

        // Tính toán mức giảm giá
        $discount = 0;
        $total = $request->input('total'); // Tổng giá trị đơn hàng

        if ($promotion->type === 'fixed') {
            $discount = $promotion->discount;
        } elseif ($promotion->type === 'percent') {
            $discount = ($promotion->discount / 100) * $total;
        }

        // Giới hạn mức giảm giá không vượt quá tổng giá trị đơn hàng
        if ($discount > $total) {
            $discount = $total;
        }

        // Cập nhật số lần sử dụng
        $promotion->increment('used_count');

        // Trả về phản hồi JSON, giảm giá đã áp dụng
        return response()->json([
            'message' => 'Mã giảm giá đã được áp dụng.',
            'discount' => $discount,
            'final_total' => $total - $discount
        ]);
    }

    // Lấy tất cả các khuyến mãi
    public function index()
    {
        return response()->json(Promotion::all());
    }

    // Tạo khuyến mãi mới
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'discount_amount' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $promotion = Promotion::create($validated);
        return response()->json($promotion, 201); // Trả về mã HTTP 201 khi tạo mới thành công
    }

    // Lấy thông tin khuyến mãi theo ID
    public function show($id)
    {
        $promotion = Promotion::findOrFail($id);
        return response()->json($promotion);
    }

    // Cập nhật khuyến mãi
    public function update(Request $request, $id)
    {
        $promotion = Promotion::findOrFail($id);

        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'discount_amount' => 'sometimes|required|numeric',
            'start_date' => 'sometimes|required|date',
            'end_date' => 'sometimes|required|date|after_or_equal:start_date',
        ]);

        $promotion->update($validated);

        return response()->json($promotion);
    }

    // Xóa khuyến mãi
    public function destroy($id)
    {
        $promotion = Promotion::findOrFail($id);
        $promotion->delete();

        return response()->json(['message' => 'Khuyến mãi đã được xóa thành công.'], 204);
    }
}

