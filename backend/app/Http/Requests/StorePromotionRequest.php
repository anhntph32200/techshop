<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePromotionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'code' => 'required|string|max:255', // Mã khuyến mãi, bắt buộc và tối đa 255 ký tự
            'discount' => 'required|numeric|min:0', // Bắt buộc
            'start_date' => 'required|date|before_or_equal:end_date', // Bắt buộc, định dạng ngày, trước hoặc bằng ngày kết thúc
            'end_date' => 'required|date|after_or_equal:start_date', // Bắt buộc, định dạng ngày, sau hoặc bằng ngày bắt đầu
            'usage_limit' => 'required|numeric|min:0',
            'minimum_spend' => 'required|numeric|min:0',
        ];
    }

    public function messages()
    {
        return [
            'code' => 'Mã khuyến mãi là bắt buộc.', // Mã khuyến mãi, bắt buộc và tối đa 255 ký tự
            'discount' => 'Trường bắt buộc', // Bắt buộc
            'start_date' => 'Trường bắt buộc',
            'end_date' => 'Trường bắt buộc',
            'usage_limit' => 'Trường bắt buộc',
            'minimum_spend' => 'Trường bắt buộc',
        ];
    }
}
