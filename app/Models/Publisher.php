<?php

namespace App\Models;

class Publisher extends BaseModel
{
    protected $fillable = ['name'];

    // A publisher can have many books.
    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
