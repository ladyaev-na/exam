<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'          => 'string|max:64|min:3',
            'surname'       => 'string|max:64|min:3',
            'patronymic'       => 'string|max:64|min:3',
            'login'         => 'string|min:8|max:64|unique:users|regex:/^[A-Za-z]+$/u',
            'password'      => 'string|min:8|max:255|regex:/^[A-Za-z]+$/u',
        ];
    }
}
