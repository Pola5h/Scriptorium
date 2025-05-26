<?php

namespace App\Http\Services;

use App\Repositories\BookRepository;

class BookService extends CommonService
{
    public function __construct(BookRepository $repository)
    {
        parent::__construct($repository);
    }
}
