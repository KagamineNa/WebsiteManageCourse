<?php

namespace Modules\User\src\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'group_id' => [
                'required',
                'integer',
                function ($attribute, $value, $fail) {
                    if ($value == 0) {
                        $fail('Vui lòng chọn nhóm');
                    }
                }
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'required' => ':attribute bắt buộc phải nhập',
            'max' => ':attribute không được vượt quá :max ký tự',
            'min' => ':attribute phải có ít nhất :min ký tự',
            'email' => ':attribute không đúng định dạng',
            'integer' => ':attribute phải là số nguyên',
            'unique' => ':attribute đã tồn tại',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Tên người dùng',
            'email' => 'Email',
            'password' => 'Mật khẩu',
            'group_id' => 'Nhóm người dùng',
        ];
    }
}
