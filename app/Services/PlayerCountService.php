<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PlayerCountService
{
    public function count(): int
    {
        return (int) Cache::remember('game.player_count', 30, function () {
            return $this->fetch();
        });
    }

    private function fetch(): int
    {
        $url = (string) (config('services.game.status_url') ?: env('GAME_STATUS_URL', ''));
        if ($url !== '') {
            try {
                $response = Http::timeout(2)->acceptJson()->get($url);
                if ($response->successful()) {
                    return (int) ($response->json('online') ?? $response->json('count') ?? 0);
                }
            } catch (\Throwable $e) {
                Log::warning('game.status_url unreachable', ['exception' => $e->getMessage()]);
            }
        }

        // Fallback: count distinct players with activity in the last 24h via the
        // void variables table. Looks for any int_value > 0 on a `last_seen`
        // variable. If the schema doesn't have such a key, this returns 0.
        try {
            $value = DB::connection('pgsql_game')
                ->table('variables')
                ->where('name', 'last_seen')
                ->where('int_value', '>', now()->subDay()->timestamp)
                ->count();
            return $value;
        } catch (\Throwable $e) {
            return 0;
        }
    }
}
