<?php

namespace App\Models;

class Book extends BaseModel
{
    // The fields that are mass assignable.
    protected $fillable = ['title', 'author_id', 'publisher_id'];

    // A book belongs to an author.
    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    // A book belongs to a publisher.
    public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }
}
