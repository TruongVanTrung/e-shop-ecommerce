<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'email' => 'required|email|min:5|max:255',
            'phone' => 'bail|required|numeric|digits_between:9,11', //digits_between
            'address' => 'required|min:5|max:255',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif|max:1024',
            'country' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'required' => ':attribute không được để trống',
            'min' => ':attribute không được độ dài nhỏ hơn :min',
            'max' => ':attribute không được độ dài lớn hơn :max',
            'numeric' => ':attribute nhập vào phải là số',
            'digits_between' => ':attribute nhập vào phải là từ 9-11 ký tự',
            'email' => ':attribute nhập vào phải là email',
            'image' => ':attribute nhập vào phải là image'
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'Tên',
            'email' => 'Email',
            'phone' => 'Số điện thoại',
            'address' => 'Địa chỉ',
            'avatar' => 'Avatar',
            'country' => 'COuntry'
        ];
    }
}
