<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DisplaynameChange extends Model
{
    protected $fillable = ['user_account_id', 'old_name', 'new_name', 'requested_at', 'applied_at', 'status'];

    protected $casts = [
        'requested_at' => 'datetime',
        'applied_at' => 'datetime',
    ];
}
