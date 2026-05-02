<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserEmail extends Model
{
    protected $fillable = ['user_account_id', 'email', 'verified_at'];

    protected $casts = [
        'verified_at' => 'datetime',
    ];
}
