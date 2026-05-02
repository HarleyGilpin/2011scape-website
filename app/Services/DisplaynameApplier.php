<?php

namespace App\Services;

use App\Models\DisplaynameChange;
use Illuminate\Support\Facades\DB;

class DisplaynameApplier
{
    private const STRING_TYPE = 6;

    private const READ_CONNECTION = 'pgsql_game';
    private const WRITE_CONNECTION = 'pgsql_game_writer';

    public function isTaken(string $name, int $excludeAccountId = 0): bool
    {
        $lower = mb_strtolower($name);

        $accountClash = DB::connection(self::READ_CONNECTION)
            ->table('accounts')
            ->whereRaw('LOWER(name) = ?', [$lower])
            ->where('id', '!=', $excludeAccountId)
            ->exists();

        if ($accountClash) {
            return true;
        }

        return DB::connection(self::READ_CONNECTION)
            ->table('variables')
            ->where('name', 'display_name')
            ->whereRaw('LOWER(string_value) = ?', [$lower])
            ->where('player_id', '!=', $excludeAccountId)
            ->exists();
    }

    public function apply(DisplaynameChange $change): void
    {
        DB::connection(self::WRITE_CONNECTION)->statement(
            <<<'SQL'
            INSERT INTO variables (player_id, name, type, string_value)
            VALUES (?, 'display_name', ?, ?)
            ON CONFLICT (player_id, name) DO UPDATE SET string_value = EXCLUDED.string_value, type = EXCLUDED.type
            SQL,
            [$change->user_account_id, self::STRING_TYPE, $change->new_name],
        );

        $change->forceFill([
            'applied_at' => now(),
            'status' => 'applied',
        ])->save();
    }
}
