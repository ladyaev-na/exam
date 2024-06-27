<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttractionUpdateRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'string|min:1|max:32',
            'description' => 'string|min:1|max:255',
            'price' => [ 'numeric', 'min:0', 'regex:/^\d{1,8}(\.\d{1,2})?$/'],
            'category_attraction_id' => 'integer|min:1',
        ];
    }
}
