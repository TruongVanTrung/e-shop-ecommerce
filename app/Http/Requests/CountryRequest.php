<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CountryRequest extends FormRequest
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
            'name' => 'required|max:255'
        ];
    }
    public function messages()
    {
        return [
            'required' => ':attribute không được để trống',
            'max' => ':attribute độ dài không được lớn hơn :max',
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'Country Name',
        ];
    }
}
