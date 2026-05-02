<?php

namespace App\Http\Controllers;

use App\Models\KbCategory;
use App\Repositories\KbaseRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class KbaseController extends Controller
{
    public function __construct(private readonly KbaseRepository $kb) {}

    public function show(string $slug): View
    {
        $article = $this->kb->bySlug($slug);
        abort_unless($article !== null, 404);

        return view('kbase.article', ['article' => $article]);
    }

    public function search(Request $request): View
    {
        $q = (string) $request->query('q', '');
        $results = $this->kb->search($q);

        return view('kbase.search', ['q' => $q, 'results' => $results]);
    }

    public function category(string $slug): View
    {
        $category = KbCategory::query()->where('slug', $slug)->firstOrFail();
        $articles = $category->articles()->orderBy('title')->paginate(50);

        return view('kbase.category', ['category' => $category, 'articles' => $articles]);
    }
}
