<?php

namespace App\Http\Controllers;

use App\Http\Services\PublisherService;

class PublisherController extends CommonController
{
    public function __construct(PublisherService $service)
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
