<?php

namespace App\Repositories;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class HiscoresRepository
{
    private const CONNECTION = 'pgsql_game';

    public function topByOverall(int $limit = 50): Collection
    {
        return DB::connection(self::CONNECTION)
            ->table('player_skills')
            ->selectRaw('username, total_xp, total_level, RANK() OVER (ORDER BY total_xp DESC) AS rank')
            ->orderByDesc('total_xp')
            ->limit($limit)
            ->get();
    }

    public function topBySkill(int $skillId, int $limit = 50): Collection
    {
        return DB::connection(self::CONNECTION)
            ->table('player_skills')
            ->selectRaw('username, level, xp, RANK() OVER (ORDER BY xp DESC) AS rank')
            ->where('skill_id', $skillId)
            ->orderByDesc('xp')
            ->limit($limit)
            ->get();
    }

    public function rankFor(string $username, int $skillId): ?object
    {
        $sub = DB::connection(self::CONNECTION)
            ->table('player_skills')
            ->selectRaw('username, level, xp, RANK() OVER (ORDER BY xp DESC) AS rank')
            ->where('skill_id', $skillId);

        return DB::connection(self::CONNECTION)
            ->query()
            ->fromSub($sub, 'r')
            ->where('username', $username)
            ->first();
    }
}
