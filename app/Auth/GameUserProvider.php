<?php

namespace App\Auth;

use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Database\Eloquent\Builder;

class GameUserProvider extends EloquentUserProvider implements UserProvider
{
    public function retrieveByCredentials(array $credentials): ?Authenticatable
    {
        if ($credentials === [] || (count($credentials) === 1 && array_key_exists('password', $credentials))) {
            return null;
        }

        $query = $this->newModelQuery();

        foreach ($credentials as $key => $value) {
            if ($key === 'password') {
                continue;
            }

            if ($key === 'name') {
                $query->whereRaw('LOWER(name) = ?', [mb_strtolower((string) $value)]);
                continue;
            }

            if (is_array($value) || $value instanceof \Illuminate\Contracts\Support\Arrayable) {
                $query->whereIn($key, $value);
            } else {
                $query->where($key, $value);
            }
        }

        return $query->first();
    }

    public function validateCredentials(Authenticatable $user, array $credentials): bool
    {
        $plain = $credentials['password'] ?? null;
        if (! is_string($plain) || $plain === '') {
            return false;
        }

        $hash = $user->getAuthPassword();
        if ($hash === '') {
            return false;
        }

        return password_verify($plain, $this->normalizeBcryptPrefix($hash));
    }

    private function normalizeBcryptPrefix(string $hash): string
    {
        if (str_starts_with($hash, '$2a$') || str_starts_with($hash, '$2b$')) {
            return '$2y$' . substr($hash, 4);
        }

        return $hash;
    }
}
