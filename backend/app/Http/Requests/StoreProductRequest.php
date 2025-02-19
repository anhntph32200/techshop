<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Đảm bảo trả về true
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'content' => 'required|string',
            'description' => 'required|string',
            'listed_price' => 'required|array|min:1',
            'listed_price.*' => 'required|numeric|min:0',
            'sale_price' => 'required|array|min:1',
            'sale_price.*' => 'required|numeric|min:0',
            'quantity' => 'required|array|min:1',
            'quantity.*' => 'required|integer|min:1',
            'chip_id' => 'required|array|min:1',
            'chip_id.*' => 'required|exists:chips,id',
            'ram_id' => 'required|array|min:1',
            'ram_id.*' => 'required|exists:rams,id',
            'storage_id' => 'required|array|min:1',
            'storage_id.*' => 'required|exists:storages,id',
            'is_show_home' => 'required|boolean',
            'sub_category_id' => 'required|exists:sub_categories,id',
            'image' => 'nullable|image|max:2048',
            'images' => 'nullable|array',
            'images.*' => 'image|max:2048', // Mỗi ảnh phải là ảnh hợp lệ và không quá 2MB
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên sản phẩm là bắt buộc.',
            'content.required' => 'Nội dung sản phẩm là bắt buộc.',
            'description.required' => 'Mô tả sản phẩm là bắt buộc.',
            'listed_price.required' => 'Giá niêm yết là bắt buộc.',
            'listed_price.*.required' => 'Giá niêm yết cho mỗi biến thể là bắt buộc.',
            'listed_price.*.numeric' => 'Giá niêm yết phải là số.',
            'listed_price.*.min' => 'Giá niêm yết phải lớn hơn hoặc bằng 0.',
            'sale_price.required' => 'Giá bán là bắt buộc.',
            'sale_price.*.required' => 'Giá bán cho mỗi biến thể là bắt buộc.',
            'sale_price.*.numeric' => 'Giá bán phải là số.',
            'sale_price.*.min' => 'Giá bán phải lớn hơn hoặc bằng 0.',
            'quantity.required' => 'Số lượng là bắt buộc.',
            'quantity.*.required' => 'Số lượng cho mỗi biến thể là bắt buộc.',
            'quantity.*.integer' => 'Số lượng phải là số nguyên.',
            'quantity.*.min' => 'Số lượng phải lớn hơn hoặc bằng 1.',
            'chip_id.required' => 'Vui lòng chọn ít nhất 1 chip.',
            'chip_id.*.required' => 'Chip là bắt buộc cho mỗi biến thể.',
            'chip_id.*.exists' => 'Chip không hợp lệ.',
            'ram_id.required' => 'Vui lòng chọn ít nhất 1 RAM.',
            'ram_id.*.required' => 'RAM là bắt buộc cho mỗi biến thể.',
            'ram_id.*.exists' => 'RAM không hợp lệ.',
            'storage_id.required' => 'Vui lòng chọn ít nhất 1 dung lượng lưu trữ.',
            'storage_id.*.required' => 'Dung lượng lưu trữ là bắt buộc cho mỗi biến thể.',
            'storage_id.*.exists' => 'Dung lượng lưu trữ không hợp lệ.',
            'is_show_home.required' => 'Vui lòng chọn trạng thái hiển thị.',
            'sub_category_id.required' => 'Vui lòng chọn danh mục phụ.',
            'sub_category_id.exists' => 'Danh mục phụ không hợp lệ.',
            'image.image' => 'Ảnh đại diện phải là file hình ảnh.',
            'image.max' => 'Ảnh đại diện không được vượt quá 2MB.',
            'images.*.image' => 'Mỗi file trong hình ảnh phải là hình ảnh hợp lệ.',
            'images.*.max' => 'Mỗi file ảnh không được vượt quá 2MB.',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $chipIds = $this->input('chip_id');
            $ramIds = $this->input('ram_id');
            $storageIds = $this->input('storage_id');

            // Kiểm tra nếu số lượng các mảng khác nhau hoặc không có
            if (count($chipIds) !== count($ramIds) || count($ramIds) !== count($storageIds)) {
                $validator->errors()->add('variants', 'Số lượng chip, RAM và dung lượng lưu trữ phải đồng đều.');
            }

            $combinationSet = [];

            // Kiểm tra xem có sự trùng lặp hay không
            foreach ($chipIds as $index => $chipId) {
                $combination = $chipId . '-' . $ramIds[$index] . '-' . $storageIds[$index];

                if (in_array($combination, $combinationSet)) {
                    $validator->errors()->add('variants', 'Các biến thể sản phẩm không được trùng lặp giữa chip, RAM và dung lượng lưu trữ.');
                    break;
                }

                // Lưu tổ hợp để kiểm tra cho lần tiếp theo
                $combinationSet[] = $combination;
            }
        });
    }
}
