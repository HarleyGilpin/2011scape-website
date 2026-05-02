<?php

namespace App\Repositories;

use App\Models\KbArticle;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class KbaseRepository
{
    private const HEADLINE_OPTS = 'StartSel=<mark>,StopSel=</mark>,MaxFragments=2,FragmentDelimiter= … ,MinWords=8,MaxWords=22';

    public function search(string $q, int $perPage = 20): LengthAwarePaginator
    {
        $term = trim($q);

        if ($term === '') {
            return KbArticle::query()->orderBy('title')->paginate($perPage);
        }

        $tsquery = 'plainto_tsquery(?, ?)';
        $headline = "ts_headline(?, search_text, {$tsquery}, ?) AS snippet";

        return KbArticle::query()
            ->select('kb_articles.*')
            ->selectRaw($headline, ['english', 'english', $term, self::HEADLINE_OPTS])
            ->whereRaw("search_tsv @@ {$tsquery}", ['english', $term])
            ->orderByRaw("ts_rank(search_tsv, {$tsquery}) DESC", ['english', $term])
            ->paginate($perPage)
            ->appends(['q' => $q]);
    }

    public function bySlug(string $slug): ?KbArticle
    {
        return KbArticle::query()->with('category')->where('slug', $slug)->first();
    }
}
