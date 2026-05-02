<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class GameAccount extends Authenticatable
{
    protected $connection = 'pgsql_game';

    protected $table = 'accounts';

    public $timestamps = false;

    protected $hidden = ['password'];

    public function getAuthIdentifierName(): string
    {
        return 'username';
    }

    public function username(): string
    {
        return $this->getAttribute('username');
    }
}
