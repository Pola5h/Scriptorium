<?php

namespace App\Models;

class Author extends BaseModel
{
    protected $fillable = ['name'];

    // An author can have many books.
    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
