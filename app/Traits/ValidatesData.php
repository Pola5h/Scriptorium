<?php

namespace App\Traits;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

trait ValidatesData
{
    /**
     * Validates the provided data using the given rules.
     *
     * @param  array  $data  The data to validate.
     * @param  array  $rules  The validation rules.
     * @param  array  $messages  Optional custom messages.
     * @return array The validated data.
     *
     * @throws ValidationException
     */
    public function validateData(array $data, array $rules, array $messages = []): array
    {
        $validator = Validator::make($data, $rules, $messages);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return $validator->validated();
    }
}
