<?php

namespace Modules\Auth\src\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:students,email',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
            'phone' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute bắt buộc phải nhập',
            'email' => ':attribute không đúng định dạng email',
            'unique' => ':attribute đã tồn tại',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Họ và tên',
            'email' => 'Email',
            'password' => 'Mật khẩu',
            'confirm_password' => 'Nhập lại mật khẩu',
            'phone' => 'Số điện thoại',
        ];
    }

}