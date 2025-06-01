<?php

namespace App\Http\Services;

use App\Repositories\PublisherRepository;

class PublisherService extends CommonService
{
    public function __construct(PublisherRepository $repository)
    {
        parent::__construct($repository);
    }

    // Publisher-specific business logic goes here.
}
