<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
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
