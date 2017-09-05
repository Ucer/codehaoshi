<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateQuestionCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $id = $this->route('id');
        return [
            'name' => 'required',
            'slug' => 'required', Rule::unique('question_categories')->ignore($id),
            'image_url' => 'required',
            'description' => 'required',
        ];
    }
}
