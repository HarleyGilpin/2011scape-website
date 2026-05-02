<?php

namespace App\Http\Controllers;

use App\Models\DevblogPost;
use App\Models\HotTopic;
use App\Models\KbArticle;
use App\Models\NewsItem;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        return view('home', [
            'news' => NewsItem::query()->orderByDesc('published_at')->limit(6)->get(),
            'devblogs' => DevblogPost::query()->orderByDesc('published_at')->limit(6)->get(),
            'articles' => KbArticle::query()->inRandomOrder()->limit(6)->get(),
            'hottopics' => HotTopic::query()->orderBy('position')->get(),
            'slides' => [
                [
                    'image' => '/img/main/home2010/banners/king-of-the-dwarves.jpg',
                    'href' => '/news/the-wilderness-and-free-trade-will-return',
                    'title' => 'King of the Dwarves',
                    'caption' => "Civil unrest and chaos dwarves beset the Consortium. Can Keldagrim's problems be solved by the king of the dwarves?",
                ],
                [
                    'image' => '/img/main/home2010/banners/10th-anniversary.jpg',
                    'href' => '/competition-details',
                    'title' => '10th Anniversary Giveaway',
                    'caption' => "Celebrate RuneScape's 10th anniversary with us and win prizes every month!",
                ],
                [
                    'image' => '/img/main/home2010/banners/game-bar.jpg',
                    'href' => '/play',
                    'title' => 'Get Started',
                    'caption' => 'Download the launcher and jump into 2011scape — the No. 1 free MMORPG.',
                ],
            ],
            'features' => [
                ['id' => 'fUpgrade', 'href' => '/members', 'title' => 'Members Area', 'desc' => 'All membership benefits are free here.', 'cta' => 'Enter'],
                ['id' => 'fProfile', 'href' => '/hiscores', 'title' => "Adventurer's Log", 'desc' => 'See what you and your friends have been up to.', 'cta' => 'View'],
                ['id' => 'fGuide', 'href' => '/kb', 'title' => 'Game Guide', 'desc' => 'Brush up with 1,231 knowledge-base articles.', 'cta' => 'Learn more'],
                ['id' => 'fHiscore', 'href' => '/hiscores', 'title' => 'Hiscores', 'desc' => "Compare your progress with the rest of the realm.", 'cta' => 'Compare'],
                ['id' => 'fGrand', 'href' => '/items', 'title' => 'Item Database', 'desc' => 'Browse 10,171 item definitions from the live cache.', 'cta' => 'Browse'],
            ],
        ]);
    }
}
