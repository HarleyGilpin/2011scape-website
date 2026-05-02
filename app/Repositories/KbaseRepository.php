<?php

namespace App\Repositories;

use App\Models\KbArticle;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class KbaseRepository
{
    public function search(string $q, int $perPage = 20): LengthAwarePaginator
    {
        $term = trim($q);

        if ($term === '') {
            return KbArticle::query()->orderBy('title')->paginate($perPage);
        }

        return KbArticle::query()
            ->whereRaw('search_tsv @@ plainto_tsquery(?, ?)', ['english', $term])
            ->orderByRaw('ts_rank(search_tsv, plainto_tsquery(?, ?)) DESC', ['english', $term])
            ->paginate($perPage)
            ->appends(['q' => $q]);
    }

    public function bySlug(string $slug): ?KbArticle
    {
        return KbArticle::query()->with('category')->where('slug', $slug)->first();
    }
}
