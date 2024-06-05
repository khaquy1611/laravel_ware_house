<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class AuthRequest extends FormRequest
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
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required',
        ];
    }

    public function messages() : array {
        return [
            'email.required' => '(*) Bạn chưa nhập vào email',
            'email.string' => '(*) Email phải ở dạng chuỗi',
            'email.email' => '(*) Email chưa đúng định dạng. Ví dụ: abc@gmail.com',
            'email.email' => '(*) Email chỉ có độ dài tối đa 255 kí tự',
            'email.unique' => '(*) Email đã tồn tại',
            'password.required' => '(*) Bạn chưa nhập mật khẩu',
        ];
    }

    public function failedValidation(Validator $validator) {
        throw new HttpResponseException(response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'data' => $validator->errors()
        ]));
    }
}
