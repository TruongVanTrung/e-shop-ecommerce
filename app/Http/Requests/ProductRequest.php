<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:5|max:255',
            'price' => 'bail|required|numeric|max:255',
            'category' => 'required', //digits_between
            'brand' => 'required',
            'status' => 'required',
            'sale' => 'numeric',
            // 'image' => 'required',
            'image.*' => 'required|mimes:jpeg,png,jpg,gif|max:1024',
            'company' => 'required',
            'detail' => 'required|max:255'
        ];
    }
    public function messages()
    {
        return [
            'required' => ':attribute không được để trống',
            'min' => ':attribute không được độ dài nhỏ hơn :min',
            'max' => ':attribute không được độ dài lớn hơn :max',
            'numeric' => ':attribute nhập vào phải là số',
            'image.*' => ':attribute nhập vào phải là image',
            'mines' => ':attribute phải là jpeg,png,jpg,gif'
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Tên',
            'price' => 'Giá',
            'category' => 'Danh mục',
            'brand' => 'Thương hiệu',
            'image.*' => 'Ảnh',
            'company' => 'công ty',
            'status' => 'trạng thái',
            'sale' => 'sale',
            'detail' => 'Chi tiết'
        ];
    }
}
