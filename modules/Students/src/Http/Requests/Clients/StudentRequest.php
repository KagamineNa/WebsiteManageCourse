<?php

namespace Modules\Students\src\Http\Requests\Clients;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StudentRequest extends FormRequest
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
            'name' => 'required|max:255',
            'email' => 'required|email|unique:students,email,' . $id,
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:11',
            'address' => 'required',
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'required' => ':attribute bắt buộc phải nhập',
            'email' => ':attribute không đúng định dạng email',
            'unique' => ':attribute đã tồn tại',
            'min' => ':attribute phải có ít nhất :min ký tự',
            'max' => ':attribute không được vượt quá :max ký tự',
            'regex' => ':attribute không đúng định dạng',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Tên học viên',
            'email' => 'Email',
            'phone' => 'Số điện thoại',
            'address' => 'Địa chỉ',
        ];
    }

}