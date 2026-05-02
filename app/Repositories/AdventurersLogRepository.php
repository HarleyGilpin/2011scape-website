<?php

namespace App\Repositories;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class AdventurersLogRepository
{
    private const CONNECTION = 'pgsql_game';

    public function profile(string $username): ?object
    {
        return DB::connection(self::CONNECTION)
            ->table('accounts')
            ->where('username', $username)
            ->first();
    }

    public function recentActivity(string $username, int $n = 10): Collection
    {
        return DB::connection(self::CONNECTION)
            ->table('player_activity')
            ->where('username', $username)
            ->orderByDesc('created_at')
            ->limit($n)
            ->get();
    }
}
