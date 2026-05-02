<?php

namespace App\Http\Controllers;

use App\Models\HotTopic;
use App\Models\NewsItem;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        return view('home', [
            'news' => NewsItem::query()->orderByDesc('published_at')->limit(3)->get(),
            'hottopics' => HotTopic::query()->orderBy('position')->get(),
        ]);
    }
}
