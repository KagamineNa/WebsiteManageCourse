<?php

namespace Modules\Lessons\src\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LessonRequest extends FormRequest
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
        $rules = [
            'name' => 'required|max:255',
            'slug' => 'required|max:255',
            'parent_id' => 'required|integer',
            'is_trial' => 'required|integer',
            'position' => 'required|integer',

        ];
        if ($this->parent_id !== 0) {
            $rules['parent_id'] = 'required';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'required' => ':attribute không được để trống',
            'email' => ':attribute không đúng định dạng email',
            'integer' => ':attribute phải là số nguyên',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Tên bài giảng',
            'slug' => 'Đường dẫn',
            'parent_id' => 'Nhóm bài giảng',
            'is_trial' => 'Học thử',
            'position' => 'Thứ tự',
        ];
    }
}