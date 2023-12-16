<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordRequest extends FormRequest
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
            'password' => 'required | min:8',
            'password_confirmation' => 'required | same:password',
            'password_old' => 'required | min:8',
        ];
    }

    public function messages(): array
    {
        return [
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.min'    => 'Vui lòng nhập mật khẩu có ít nhất 8 ký tự',
            'password_confirmation.same' => 'Xác nhận sai mật khẩu',
            'password_confirmation.required' => 'Vui lòng xác nhận mật khẩu',
            'password_old.required' => 'Vui lòng nhập mật khẩu',
            'password_old.min'    => 'Vui lòng nhập mật khẩu có ít nhất 8 ký tự',
        ];
    }
}
