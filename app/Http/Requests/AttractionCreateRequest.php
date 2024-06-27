<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttractionCreateRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|min:1|max:32',
            'description' => 'required|string|min:1|max:255',
            'price' => ['required', 'numeric', 'min:0', 'regex:/^\d{1,8}(\.\d{1,2})?$/'],
            'category_attraction_id' => 'required|integer|min:1',
        ];
    }
}
