<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Setting extends FormRequest
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
            'ratio' => 'required|numeric|min:0|max:1',
            'earn1' => 'required|numeric|min:0|max:1',
            'earn2' => 'required|numeric|min:0|max:1',
            'earn3' => 'required|numeric|min:0|max:1',
            'earn4' => 'required|numeric|min:0|max:1',
            'earn5' => 'required|numeric|min:0|max:1',
        ];
    }

    public function messages(): array
    {
        return [
            //
            'ratio.required' => 'Yêu cầu nhập',
            'ratio.numeric' => 'Sai định dạng',
            'ratio.min' => 'Tối thiểu 0',
            'ratio.max' => 'Tối đa 1',
            'earn1.required' => 'Yêu cầu nhập',
            'earn1.numeric' => 'Sai định dạng',
            'earn1.min' => 'Tối thiểu 0',
            'earn1.max' => 'Tối đa 1',
            'earn2.required' => 'Yêu cầu nhập',
            'earn2.numeric' => 'Sai định dạng',
            'earn2.min' => 'Tối thiểu 0',
            'earn2.max' => 'Tối đa 1',
            'earn3.required' => 'Yêu cầu nhập',
            'earn3.numeric' => 'Sai định dạng',
            'earn3.min' => 'Tối thiểu 0',
            'earn3.max' => 'Tối đa 1',
            'earn4.required' => 'Yêu cầu nhập',
            'earn4.numeric' => 'Sai định dạng',
            'earn4.min' => 'Tối thiểu 0',
            'earn4.max' => 'Tối đa 1',
            'earn5.required' => 'Yêu cầu nhập',
            'earn5.numeric' => 'Sai định dạng',
            'earn5.min' => 'Tối thiểu 0',
            'earn5.max' => 'Tối đa 1',
        ];
    }
}
