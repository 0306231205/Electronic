<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddProductRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'category' => 'required|integer',
            'type' => 'required|integer|in:0,1,2,3',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'brand' => 'nullable|integer',
            'tag' => 'nullable|string|max:255',
            'status' => 'nullable|integer',
            'supplier' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên sản phẩm',
            'name.min' => 'Tên sản phẩm phải có ít nhất 3 ký tự',

            'price.required' => 'Vui lòng nhập giá sản phẩm',
            'price.numeric' => 'Giá phải là số hợp lệ',
            'price.min' => 'Giá phải lớn hơn hoặc bằng 0',

            'discount_price.required' => 'Vui lòng nhập giá giảm',
            'discount_price.numeric' => 'Giá giảm phải là số hợp lệ',
            'discount_price.min' => 'Giá giảm phải lớn hơn hoặc bằng 0',

            'category.required' => 'Vui lòng chọn loại sản phẩm',
            'category.integer' => 'Loại sản phẩm không hợp lệ',

            'type.required' => 'Vui lòng chọn loại',
            'type.integer' => 'Loại không hợp lệ',
            'type.in' => 'Loại không hợp lệ',

            'brand.nullable' => 'Vui lòng chọn thương hiệu',
            'brand.integer' => 'Thương hiệu không hợp lệ',

            'supplier.required' => 'Vui lòng nhập nhà cung cấp',
            'supplier.integer' => 'Nhà cung cấp không hợp lệ',

            'image.image' => 'Tệp tải lên phải là hình ảnh',
            'image.max' => 'Kích thước ảnh không được vượt quá 2MB',

            'tag.string' => 'Tag không hợp lệ',
            'status.integer' => 'Trạng thái phải là số',
        ];
    }
}
