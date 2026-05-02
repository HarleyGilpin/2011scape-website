<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotTopic extends Model
{
    protected $table = 'hottopics';

    protected $fillable = ['position', 'label', 'image', 'url', 'byline'];
}
