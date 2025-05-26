<?php

namespace App\Repositories;

use App\Models\Author;

class AuthorRepository extends CommonRepository
{
    protected string $modelClass = Author::class;
}
