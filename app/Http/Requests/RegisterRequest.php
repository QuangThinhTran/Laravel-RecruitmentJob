<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required',
            'username' => 'required | unique:user',
            'email' => 'required | email | indisposable | unique:user',
            'phone' => 'required | unique:user',
            'password' => 'required | min:8',
            'password_confirmation' => 'required | same:password',
            'address' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Vui lòng nhập tên hiển thị',
            'username.required' => 'Vui lòng nhập tên đăng nhập',
            'username.unique' => 'Tên đăng nhập đã được sử dụng',
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Vui lòng đúng định dạng @',
            'email.indisposable' => 'Địa chỉ email không tồn tại',
            'email.unique' => 'Email đã được sử dụng',
            'phone.required' => 'Vui lòng nhập số điện thoại',
            'phone.unique' => 'Số điện thoại đã được sử dụng',
            'address.required' => 'Vui lòng nhập địa chỉ',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.min'    => 'Vui lòng nhập mật khẩu có ít nhất 8 ký tự',
            'password_confirmation.same' => 'Xác nhận sai mật khẩu',
            'password_confirmation.required' => 'Vui lòng xác nhận mật khẩu',
        ];
    }
}
