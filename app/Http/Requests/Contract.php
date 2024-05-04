<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Contract extends FormRequest
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
            'name' => 'required|max:200',
            'client_id_value' => 'required|exists:clients,id',
            'property_id_value' => 'required|exists:properties,id',
            'price' => 'required|numeric|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            //
            'name.required' => 'Vui lòng nhập.',
            'name.max' => 'Tối đa 200 ký tự.',
            'client_id_value.required' => 'Vui lòng nhập',
            'client_id_value.exists' => 'Không tồn tại.',
            'property_id_value.required' => 'Vui lòng nhập.',
            'property_id_value.exists' => 'Không tồn tại',
            'price.required' => 'Vui lòng nhập',
            'price.numeric' => 'Sai định dạng',
            'price.min' => 'Sai định dạng',
        ];
    }
}
