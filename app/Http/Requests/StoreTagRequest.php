<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTagRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'tag' => 'required',
            'slug' => 'required|unique:tags',
            'description' => 'required',
        ];
    }
}
