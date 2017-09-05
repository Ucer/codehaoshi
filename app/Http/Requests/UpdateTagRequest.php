<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTagRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $id = $this->route('id');
        return [
            'tag' => 'required',
            'slug' => 'required', Rule::unique('tags')->ignore($id),
            'description' => 'required',
        ];
    }
}
