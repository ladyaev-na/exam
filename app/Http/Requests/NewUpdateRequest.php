<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewUpdateRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'name' => 'string|max:64|min:3',
            'description' => 'string|max:255|min:3',
        ];
    }
}
