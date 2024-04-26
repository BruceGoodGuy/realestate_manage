<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class ClientLoginRequest extends FormRequest
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
            'phone' => 'required|numeric|digits:10|exists:clients,phone',
            'password' => ['required', Password::defaults()],
        ];
    }

    public function messages()
    {
        return [
            'phone.required' => 'Vui lòng nhập số điện thoại',
            'phone.numeric' => 'Số điện thoại sai định dạng',
            'phone.digits' => 'Số điện thoại phải 10 số',
            'phone.exists' => 'Số điện thoại không tồn tại.',
            'password.required' => 'Vui lòng nhập mật khẩu',
        ];
    }
}
