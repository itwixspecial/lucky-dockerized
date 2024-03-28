<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'username' => 'required|string|max:255',
            'phonenumber' => 'required|string|max:15|unique:users,phonenumber',
        ];
    }

    public function messages()
    {
        return [
            'phonenumber.unique' => 'The phone number has already been taken.',
        ];
    }
}
