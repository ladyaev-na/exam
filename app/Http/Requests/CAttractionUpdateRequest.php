<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CAttractionUpdateRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'string|min:1|max:32',
            'code' => 'string|min:1|max:32',
        ];
    }
}
