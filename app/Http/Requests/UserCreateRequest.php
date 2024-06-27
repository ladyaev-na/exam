<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'          => 'required|string|max:64|min:3',
            'surname'       => 'required|string|max:64|min:3',
            'patronymic'       => 'string|max:64|min:3',
            'login'         => 'required|string|min:8|max:64|unique:users|regex:/^[A-Za-z]+$/',
            'password'      => 'required|string|min:8|max:255|regex:/^[A-Za-z]+$/',
        ];
    }
}
