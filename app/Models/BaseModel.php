<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

abstract class BaseModel extends Model
{
    protected $fillable = ['created_by', 'status']; // Common fields across all models

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->created_by = Auth::id() ?? null;
        });
    }
}
