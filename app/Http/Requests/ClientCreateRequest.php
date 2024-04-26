<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class ClientCreateRequest extends FormRequest
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
            'lastname' => 'required|max:100',
            'firstname' => 'required|max:100',
            'phone' => 'required|numeric|digits:10|unique:clients,phone',
            'password' => ['required', Password::defaults()],
            'email' => 'nullable|email|unique:clients,email'
        ];
    }

    public function messages()
    {
        return [
            'lastname.required' => 'Vui lòng nhập họ',
            'lastname.max' => 'Tối đa 100 kí tự',
            'firstname.required' => 'Vui lòng nhập tên',
            'firstname.max' => 'Tối đa 100 kí tự',
            'phone.required' => 'Vui lòng nhập số điện thoại',
            'phone.numeric' => 'Số điện thoại sai định dạng',
            'phone.digits' => 'Số điện thoại phải 10 số',
            'phone.unique' => 'Số điện thoại đã tồn tại.',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'email.email' => 'Email sai định dạng',
            'email.unique' => 'Email đã tồn tại.'
        ];
    }
}
