<?php

namespace App\Repositories;

use Illuminate\Support\Collection;

class ItemDbRepository
{
    public function search(string $q, int $limit = 50): Collection
    {
        $items = $this->loadAll();
        if ($items->isEmpty()) {
            return collect();
        }

        $needle = mb_strtolower($q);

        return $items
            ->filter(fn (array $item) => str_contains($this->displayName($item), $needle))
            ->take($limit)
            ->map(fn (array $item) => $this->shape($item))
            ->values();
    }

    public function find(int|string $itemId): ?object
    {
        $items = $this->loadAll();
        $key = (string) $itemId;

        $item = $items->first(fn (array $row) => (string) ($row['id'] ?? '') === $key || ($row['slug'] ?? '') === $key);

        return $item === null ? null : $this->shape($item);
    }

    private function displayName(array $item): string
    {
        return mb_strtolower(str_replace('_', ' ', (string) ($item['name'] ?? $item['slug'] ?? '')));
    }

    private function shape(array $item): object
    {
        $item['name'] = $item['name'] ?? ucwords(str_replace('_', ' ', (string) ($item['slug'] ?? '')));
        $item['description'] = $item['description'] ?? $item['examine'] ?? '';
        $item['members'] = $item['members'] ?? false;
        $item['tradeable'] = $item['tradeable'] ?? false;
        return (object) $item;
    }

    public function categories(): Collection
    {
        return $this->loadAll()
            ->pluck('category')
            ->filter(fn ($v) => $v !== null && $v !== '')
            ->unique()
            ->values()
            ->map(fn ($name) => (object) ['name' => $name]);
    }

    private function loadAll(): Collection
    {
        $path = (string) config('services.game.items_json', env('GAME_ITEMS_JSON', ''));
        if ($path !== '' && ! str_starts_with($path, '/')) {
            $path = base_path($path);
        }
        if ($path === '' || ! is_file($path)) {
            return collect();
        }

        $json = file_get_contents($path);
        if ($json === false) {
            return collect();
        }

        $data = json_decode($json, true);
        if (! is_array($data)) {
            return collect();
        }

        return collect($data)->map(function ($value, $key) {
            $row = is_array($value) ? $value : [];
            $row['id'] = $row['id'] ?? $key;
            return $row;
        });
    }
}
