<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required',
            'requirements' => 'required',
            'description' => 'required',
            'benefit' => 'required',
            'experience' => 'required',
            'workplace' => 'required',
            'quantity' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'title' => 'Bạn chưa nhập nội dung',
            'requirements' => 'Bạn chưa nhập nội dung',
            'description' => 'Bạn chưa nhập nội dung',
            'benefit' => 'Bạn chưa nhập nội dung',
            'experience' => 'Bạn chưa nhập nội dung',
            'workplace' => 'Bạn chưa nhập nội dung',
            'quantity' => 'Bạn chưa nhập nội dung',
        ];
    }
}
