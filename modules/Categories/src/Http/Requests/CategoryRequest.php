<?php

namespace Modules\Categories\src\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'slug' => 'required|max:255',
            'parent_id' => 'required|integer'
        ];
    }

    public function messages(): array
    {
        return [
            'required' => ':attribute bắt buộc phải nhập',
            'max' => ':attribute không được vượt quá :max ký tự',
            'integer' => ':attribute phải là số nguyên',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Tên chuyên mục',
            'slug' => 'Slug',
            'parent_id' => 'ID Cha',
        ];
    }
}
