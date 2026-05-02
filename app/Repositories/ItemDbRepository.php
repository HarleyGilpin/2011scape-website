<?php

namespace App\Repositories;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ItemDbRepository
{
    private const CONNECTION = 'pgsql_game';

    public function search(string $q, int $limit = 50): Collection
    {
        $like = '%'.str_replace(['%', '_'], ['\%', '\_'], $q).'%';

        return DB::connection(self::CONNECTION)
            ->table('item_definitions')
            ->where('name', 'ILIKE', $like)
            ->orderBy('name')
            ->limit($limit)
            ->get();
    }

    public function find(int $itemId): ?object
    {
        return DB::connection(self::CONNECTION)
            ->table('item_definitions')
            ->where('id', $itemId)
            ->first();
    }

    public function categories(): Collection
    {
        return DB::connection(self::CONNECTION)
            ->table('item_categories')
            ->orderBy('name')
            ->get();
    }
}
