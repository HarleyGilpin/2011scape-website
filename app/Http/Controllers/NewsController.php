<?php

namespace App\Http\Controllers;

use App\Models\NewsItem;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Response;

class NewsController extends Controller
{
    public function show(string $slug): View
    {
        $item = NewsItem::query()->where('slug', $slug)->firstOrFail();

        return view('services.news.item', ['item' => $item]);
    }

    public function index(): View
    {
        $items = NewsItem::query()->orderByDesc('published_at')->paginate(20);

        return view('services.news.index', ['items' => $items]);
    }

    public function rss(): Response
    {
        $items = NewsItem::query()->orderByDesc('published_at')->limit(50)->get();

        return response()
            ->view('services.news.rss', ['items' => $items])
            ->header('Content-Type', 'application/rss+xml; charset=UTF-8');
    }
}
