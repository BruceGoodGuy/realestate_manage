<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PropertyRequest extends FormRequest
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
            //
            "name" => "required|max:200",
            'price' => 'nullable|numeric|min:1000',
        ];
    }

    public function messages(): array
    {
        return [
            //
            "name.required" => "Tên được yêu cầu.",
            "name.max" => "Tên không quá 200 kí tự.",
            'price.numeric' => 'Giá không hợp lệ',
            'price.min' => 'Giá không hợp lệ',
        ];
    }
}
