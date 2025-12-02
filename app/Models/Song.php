<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'thumbnail',
        'audio',
    ];

    protected $casts = [
        'tags' => 'array'
    ];
}
