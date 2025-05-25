<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    protected $fillable = ['name'];

    // A publisher can have many books.
    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
