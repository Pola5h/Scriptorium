<?php

namespace App\Http\Services;

use App\Repositories\AuthorRepository;

class AuthorService extends CommonService
{
    public function __construct(AuthorRepository $repository)
    {
        parent::__construct($repository);
    }
    
    // Author-specific business logic goes here.
}
