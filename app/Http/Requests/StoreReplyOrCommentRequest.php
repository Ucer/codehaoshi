<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class StoreReplyOrCommentRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'body'     => 'required|min:2',
        ];
    }
}
