<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
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
            'title' => 'required|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:1024',
            'description' => 'required|max:255',
            'content' => 'required|max:255'
        ];
    }
    public function messages()
    {
        return [
            'required' => ':attribute không được để trống',
            'max' => ':attribute độ dài không được lớn hơn :max',
            'image' => ':attribute file phải là ảnh',
            'mimes' => ':attribute file có đuổi k phù hợp'
        ];
    }
    public function attributes()
    {
        return [
            'title' => 'Nội dung',
            'image' => 'Ảnh',
            'description' => 'Chú thích',
            'content' => 'Nội dung'
        ];
    }
}
