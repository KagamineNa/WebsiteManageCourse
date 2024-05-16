<?php

namespace Modules\Courses\src\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CoursesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        $id = $this->route()->course;

        $uniqueRule = 'unique:courses,code';

        if ($id) {
            $uniqueRule .= ',' . $id;
        }

        $rules = [
            'name' => 'required|max:255',
            'slug' => 'required|max:255',
            'detail' => 'required',
            'teacher_id' => [
                'required',
                'integer',
                function ($attribute, $value, $fail) {
                    if ($value == 0) {
                        $fail('Bạn cần phải chọn giảng viên');
                    }

                }
            ],
            'thumbnail' => 'required|max:255',
            'code' => 'required|max:255|' . $uniqueRule,
            'is_document' => 'required|integer',
            'supports' => 'required',
            'status' => 'required|integer',
            'categories' => 'required',
        ];

        return $rules;

    }

    public function messages()
    {
        return [
            'required' => ':attribute không được để trống',
            'max' => ':attribute không được quá :max ký tự',
            'integer' => ':attribute phải là số',
            'unique' => ':attribute đã tồn tại',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Tên khóa học',
            'slug' => 'Slug',
            'detail' => 'Nội dung',
            'teacher_id' => 'Giảng viên',
            'thumbnail' => 'Ảnh đại diện',
            'code' => 'Mã khóa học',
            'is_document' => 'Tài liệu đính kèm',
            'supports' => 'Hỗ trợ',
            'status' => 'Trạng thái',
            'categories' => 'Chuyên mục',
        ];
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */

}
