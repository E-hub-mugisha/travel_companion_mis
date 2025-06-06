<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    //
    protected $fillable = [
        'title',
        'content',
        'author',
        'slug',
        'image',
        'is_published',
        'published_at',
        'category',
        'tags', // Comma-separated tags
    ];
}
