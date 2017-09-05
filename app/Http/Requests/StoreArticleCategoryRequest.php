<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreArticleCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'slug' => 'required|unique:article_categories',
            'image_url' => 'required',
            'description' => 'required',
        ];
    }
}
