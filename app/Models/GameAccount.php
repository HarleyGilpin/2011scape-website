<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class GameAccount extends Authenticatable
{
    protected $connection = 'pgsql_game';

    protected $table = 'accounts';

    public $timestamps = false;

    protected $primaryKey = 'id';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $hidden = ['password_hash'];

    public function getAuthPasswordName(): string
    {
        return 'password_hash';
    }

    public function getAuthPassword(): string
    {
        return (string) ($this->getAttribute('password_hash') ?? '');
    }

    public function name(): string
    {
        return (string) ($this->getAttribute('name') ?? '');
    }

    public function getRememberToken(): ?string
    {
        return null;
    }

    public function setRememberToken($value): void {}

    public function getRememberTokenName(): string
    {
        return '';
    }

    public function displayName(): string
    {
        $row = $this->newQuery()
            ->getConnection()
            ->table('variables')
            ->where('player_id', $this->getKey())
            ->where('name', 'display_name')
            ->first();

        return (string) ($row->string_value ?? $this->name());
    }
}
