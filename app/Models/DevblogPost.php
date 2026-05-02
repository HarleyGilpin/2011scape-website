<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DevblogPost extends Model
{
    protected $fillable = [
        'slug',
        'title',
        'body_html',
        'author',
        'hero_image',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
