<?php

namespace App\Repositories;

use App\Models\Book;

class BookRepository extends CommonRepository
{
    protected string $modelClass = Book::class;
}
