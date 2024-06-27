<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewCreateRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:64|min:3',
            'description' => 'required|string|max:255|min:3',
        ];
    }
}
