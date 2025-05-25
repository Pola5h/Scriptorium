<?php

namespace App\Http\Controllers;

use App\Http\Services\BookService;

class BookController extends CommonController
{
    public function __construct(BookService $service)
    {
        $this->service = $service;
    }

    /**
     * Returns validation rules for creating/updating a book.
     *
     * @param bool $isUpdate
     * @return array
     */
    public function getRules(bool $isUpdate = false): array
    {
        $rules = [
            'title'        => 'required|string|max:255',
            'author_id'    => 'required|exists:authors,id',
            'publisher_id' => 'required|exists:publishers,id',
        ];

        if ($isUpdate) {
            $rules['title']        = 'sometimes|string|max:255';
            $rules['author_id']    = 'sometimes|exists:authors,id';
            $rules['publisher_id'] = 'sometimes|exists:publishers,id';
        }

        return $rules;
    }
}
