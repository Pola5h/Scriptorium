<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $fillable = ['name'];

    // An author can have many books.
    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
