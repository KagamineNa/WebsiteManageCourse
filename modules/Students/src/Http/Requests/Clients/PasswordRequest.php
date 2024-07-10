<?php

namespace Modules\Students\src\Http\Requests\Clients;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PasswordRequest extends FormRequest
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
        $id = Auth::guard('students')->user()->id;
        $rules = [
            'old_password' => [
                'required',
                function ($attribute, $value, $fail) use ($id) {
                    if (!\Hash::check($value, Auth::guard('students')->user()->password)) {
                        $fail('Mật khẩu không đúng');
                    }
                }
            ],
            'new_password' => 'required|min:6|max:255',
            'confirm_password' => 'required|same:new_password',
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'required' => ':attribute bắt buộc phải nhập',
            'min' => ':attribute phải có ít nhất :min ký tự',
            'max' => ':attribute không được vượt quá :max ký tự',
            'same' => 'Mật khẩu không khớp',
        ];
    }

    public function attributes()
    {
        return [
            'old_password' => 'Mật khẩu cũ',
            'new_password' => 'Mật khẩu mới',
            'confirm_password' => 'Mật khẩu mới',
        ];
    }

}