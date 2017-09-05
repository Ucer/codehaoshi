<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuestionCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'slug' => 'required|unique:question_categories',
            'image_url' => 'required',
            'description' => 'required',
        ];
    }
}
