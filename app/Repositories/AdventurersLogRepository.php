<?php

namespace App\Repositories;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class AdventurersLogRepository
{
    private const CONNECTION = 'pgsql_game';

    public function profile(string $username): ?object
    {
        $name = mb_strtolower($username);
        $account = DB::connection(self::CONNECTION)
            ->table('accounts')
            ->whereRaw('LOWER(name) = ?', [$name])
            ->first();

        if ($account === null) {
            return null;
        }

        $variables = DB::connection(self::CONNECTION)
            ->table('variables')
            ->where('player_id', $account->id)
            ->whereIn('name', ['display_name', 'name_history'])
            ->get()
            ->keyBy('name');

        $account->display_name = $variables->get('display_name')->string_value ?? $account->name;
        $account->name_history = $variables->get('name_history')->string_list_value ?? [];

        return $account;
    }

    public function skills(int $playerId): Collection
    {
        $exp = DB::connection(self::CONNECTION)
            ->table('experience')
            ->where('player_id', $playerId)
            ->first();

        $lvl = DB::connection(self::CONNECTION)
            ->table('levels')
            ->where('player_id', $playerId)
            ->first();

        if ($exp === null || $lvl === null) {
            return collect();
        }

        return collect(HiscoresRepository::SKILLS)->map(fn (string $skill) => (object) [
            'skill' => $skill,
            'level' => (int) ($lvl->{$skill} ?? 1),
            'xp' => (int) ($exp->{$skill} ?? 0),
        ]);
    }

    public function totals(Collection $skills): object
    {
        return (object) [
            'level' => $skills->sum('level'),
            'xp' => $skills->sum('xp'),
        ];
    }

    public function recentActivity(string $username, int $n = 10): Collection
    {
        $logRoot = (string) (config('services.game.log_dir', env('GAME_LOG_DIR', '')));
        if ($logRoot === '' || ! is_dir($logRoot)) {
            return collect();
        }

        $file = rtrim($logRoot, '/').'/'.str_replace([' ', '/'], '_', mb_strtolower($username)).'.tsv';
        if (! is_file($file)) {
            return collect();
        }

        $rows = collect();
        $fp = fopen($file, 'rb');
        if ($fp === false) {
            return $rows;
        }

        try {
            while (($line = fgets($fp)) !== false) {
                $parts = explode("\t", rtrim($line, "\r\n"));
                if (count($parts) < 2) {
                    continue;
                }
                $rows->prepend((object) [
                    'created_at' => $parts[0],
                    'description' => implode("\t", array_slice($parts, 1)),
                ]);
                if ($rows->count() > $n * 10) {
                    $rows = $rows->slice(0, $n * 10);
                }
            }
        } finally {
            fclose($fp);
        }

        return $rows->take($n)->values();
    }
}
