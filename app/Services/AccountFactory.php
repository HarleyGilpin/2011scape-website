<?php

namespace App\Services;

use App\Models\GameAccount;
use App\Models\UserEmail;
use Illuminate\Support\Facades\DB;

class AccountFactory
{
    private const RESERVED_NAMES = [
        'admin', 'administrator', 'root', 'mod', 'moderator', 'jagex',
        'system', 'staff', 'official', 'support', 'null', 'undefined',
    ];

    private const VARIABLE_TYPE_STRING = 6;

    public function isReserved(string $name): bool
    {
        return in_array(mb_strtolower(trim($name)), self::RESERVED_NAMES, true);
    }

    public function nameIsTaken(string $name): bool
    {
        return DB::connection('pgsql_game')
            ->table('accounts')
            ->whereRaw('LOWER(name) = ?', [mb_strtolower($name)])
            ->exists();
    }

    /** Create a new game account + bootstrap experience/levels/variables rows. Returns the new id. */
    public function create(string $name, string $plainPassword, ?string $email = null): int
    {
        $hash = password_hash($plainPassword, PASSWORD_BCRYPT);

        $accountId = DB::connection('pgsql_game_writer')->transaction(function () use ($name, $hash) {
            $id = DB::connection('pgsql_game_writer')->table('accounts')->insertGetId([
                'name' => $name,
                'password_hash' => $hash,
                'tile' => 0,
                'blocked' => '{}',
                'male' => true,
                'looks' => '{}',
                'colours' => '{}',
                'friends' => '{}',
                'ranks' => '{}',
                'ignores' => '{}',
            ]);

            DB::connection('pgsql_game_writer')->table('experience')->insert($this->skillRow($id, 0, 1154));
            DB::connection('pgsql_game_writer')->table('levels')->insert($this->skillRow($id, 1, 10));

            DB::connection('pgsql_game_writer')->table('variables')->insert([
                'player_id' => $id,
                'name' => 'display_name',
                'type' => self::VARIABLE_TYPE_STRING,
                'string_value' => $name,
            ]);

            return $id;
        });

        if ($email !== null && $email !== '') {
            UserEmail::query()->updateOrCreate(
                ['user_account_id' => $accountId],
                ['email' => $email],
            );
        }

        return $accountId;
    }

    public function findByName(string $name): ?GameAccount
    {
        return GameAccount::query()->whereRaw('LOWER(name) = ?', [mb_strtolower($name)])->first();
    }

    /** @return array<string, int|string> */
    private function skillRow(int $playerId, int $defaultValue, int $constitutionValue): array
    {
        $row = ['player_id' => $playerId];
        foreach (\App\Repositories\HiscoresRepository::SKILLS as $skill) {
            $row[$skill] = $skill === 'constitution' ? $constitutionValue : $defaultValue;
        }
        return $row;
    }
}
