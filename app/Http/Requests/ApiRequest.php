<?php

namespace App\Http\Requests;

use App\Exceptions\ApiException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class ApiRequest extends FormRequest
{
    public function failedValidation(Validator $validator)
    {
        throw new ApiException(422, ' Unprocessable Entity', $validator->errors());
    }
    public function failedAuthorization()
    {
        return throw new ApiException(401, 'Unauthorized');
    }
}
