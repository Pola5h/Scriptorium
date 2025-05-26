<?php

namespace App\Http\Controllers;

use App\Http\Services\AuthorService;

class AuthorController extends CommonController
{
    public function __construct(AuthorService $service)
    {
        $this->service = $service;
    }

    public function getRules(bool $isUpdate = false): array
    {
        $rules = [
            'name' => 'required|string|max:255',
        ];

        if ($isUpdate) {
            $rules['name'] = 'sometimes|string|max:255';
        }

        return $rules;
    }
}
