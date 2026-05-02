<?php

namespace App\Auth;

use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\Auth\Authenticatable;

class GameUserProvider extends EloquentUserProvider
{
    public function validateCredentials(Authenticatable $user, array $credentials): bool
    {
        $plain = $credentials['password'] ?? null;
        if (! is_string($plain) || $plain === '') {
            return false;
        }

        $hash = $user->getAuthPassword();
        if (! is_string($hash) || $hash === '') {
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
