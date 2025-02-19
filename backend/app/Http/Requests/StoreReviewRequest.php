<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReviewRequest extends FormRequest
{
    /**
     * Xác định xem người dùng có quyền gửi yêu cầu này hay không.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Các quy tắc xác thực cho yêu cầu này.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'product_id' => 'required|exists:products,id', // Kiểm tra xem sản phẩm có tồn tại không
            'rating' => 'required|integer|between:1,5', // Đánh giá phải là số nguyên từ 1 đến 5
            'comment' => 'required|string|max:1000', // Nhận xét không được trống và không quá 1000 ký tự
        ];
    }

    /**
     * Các thông báo lỗi tuỳ chỉnh cho các quy tắc xác thực.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'product_id.required' => 'Sản phẩm không hợp lệ.',
            'rating.required' => 'Bạn cần chọn một đánh giá sao.',
            'rating.between' => 'Đánh giá sao phải trong khoảng từ 1 đến 5.',
            'comment.required' => 'Vui lòng nhập nhận xét.',
            'comment.max' => 'Nhận xét không được vượt quá 1000 ký tự.',
        ];
    }
}

