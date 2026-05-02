<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KbArticle extends Model
{
    protected $fillable = [
        'slug',
        'title',
        'category_id',
        'body_html',
        'search_text',
        'legacy_path',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(KbCategory::class, 'category_id');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
