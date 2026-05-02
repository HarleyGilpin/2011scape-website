<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    protected $fillable = ['token', 'user_account_id', 'expires_at'];

    protected $casts = [
        'expires_at' => 'datetime',
    ];
}
