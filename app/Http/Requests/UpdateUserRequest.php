<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $id = $this->route('id');
        return [
            'user_name' => 'alpha_num|required', Rule::unique('users')->ignore($id),
            'email' => 'email|required', Rule::unique('users')->ignore($id),
        ];
    }
}
