<?php

namespace App\Repositories;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class HiscoresRepository
{
    private const CONNECTION = 'pgsql_game';

    public const SKILLS = [
        'attack', 'defence', 'strength', 'constitution', 'ranged', 'prayer', 'magic',
        'cooking', 'woodcutting', 'fletching', 'fishing', 'firemaking', 'crafting',
        'smithing', 'mining', 'herblore', 'agility', 'thieving', 'slayer', 'farming',
        'runecrafting', 'hunter', 'construction', 'summoning', 'dungeoneering',
    ];

    public function topByOverall(int $limit = 50): Collection
    {
        $sumXp = $this->sumExpression('e');
        $sumLevel = $this->sumExpression('l');

        return DB::connection(self::CONNECTION)
            ->table('accounts as a')
            ->join('experience as e', 'a.id', '=', 'e.player_id')
            ->join('levels as l', 'a.id', '=', 'l.player_id')
            ->selectRaw("a.id, a.name, ({$sumXp}) AS total_xp, ({$sumLevel}) AS total_level, RANK() OVER (ORDER BY ({$sumXp}) DESC) AS rank")
            ->orderByDesc('total_xp')
            ->limit($limit)
            ->get();
    }

    public function topBySkill(string $skill, int $limit = 50): Collection
    {
        $skill = $this->validateSkill($skill);

        return DB::connection(self::CONNECTION)
            ->table('accounts as a')
            ->join('experience as e', 'a.id', '=', 'e.player_id')
            ->join('levels as l', 'a.id', '=', 'l.player_id')
            ->selectRaw("a.id, a.name, l.{$skill} AS level, e.{$skill} AS xp, RANK() OVER (ORDER BY e.{$skill} DESC) AS rank")
            ->orderByDesc("e.{$skill}")
            ->limit($limit)
            ->get();
    }

    public function rankFor(string $username, ?string $skill = null): ?object
    {
        $name = mb_strtolower($username);

        if ($skill === null) {
            $sumXp = $this->sumExpression('e');
            $sub = DB::connection(self::CONNECTION)
                ->table('accounts as a')
                ->join('experience as e', 'a.id', '=', 'e.player_id')
                ->selectRaw("LOWER(a.name) AS lname, a.name, ({$sumXp}) AS total_xp, RANK() OVER (ORDER BY ({$sumXp}) DESC) AS rank");
        } else {
            $skill = $this->validateSkill($skill);
            $sub = DB::connection(self::CONNECTION)
                ->table('accounts as a')
                ->join('experience as e', 'a.id', '=', 'e.player_id')
                ->join('levels as l', 'a.id', '=', 'l.player_id')
                ->selectRaw("LOWER(a.name) AS lname, a.name, l.{$skill} AS level, e.{$skill} AS xp, RANK() OVER (ORDER BY e.{$skill} DESC) AS rank");
        }

        return DB::connection(self::CONNECTION)
            ->query()
            ->fromSub($sub, 'r')
            ->where('lname', $name)
            ->first();
    }

    private function sumExpression(string $alias): string
    {
        return implode(' + ', array_map(fn ($s) => "{$alias}.{$s}", self::SKILLS));
    }

    private function validateSkill(string $skill): string
    {
        $skill = mb_strtolower($skill);
        if (! in_array($skill, self::SKILLS, true)) {
            throw new \InvalidArgumentException("Unknown skill: {$skill}");
        }
        return $skill;
    }
}
