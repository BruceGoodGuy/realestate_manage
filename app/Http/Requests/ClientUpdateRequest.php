<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;

class ClientUpdateRequest extends FormRequest
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
            'password' => ['nullable', Password::defaults()],
            'email' => [
                'nullable', 'email',
                Rule::unique('users')->ignore(request()->clientId),
            ],
        ];
    }

    public function messages()
    {
        return [
            'lastname.required' => 'Vui lòng nhập họ',
            'lastname.max' => 'Tối đa 100 kí tự',
            'firstname.required' => 'Vui lòng nhập tên',
            'firstname.max' => 'Tối đa 100 kí tự',
            'email.email' => 'Email sai định dạng',
            'email.unique' => 'Email đã tồn tại.'
        ];
    }
}
