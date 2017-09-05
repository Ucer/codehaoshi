<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'user_name' => 'alpha_num|required|unique:users',
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed|min:6',
        ];
    }
}
