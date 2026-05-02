<?php

namespace Database\Seeders;

use App\Models\NewsItem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Symfony\Component\DomCrawler\Crawler;

class NewsSeeder extends Seeder
{
    public function run(): void
    {
        $entries = [
            [
                'legacy_id' => 3889,
                'slug' => 'the-wilderness-and-free-trade-will-return',
                'title' => 'The Wilderness and Free Trade Will Return!',
                'published_at' => Carbon::parse('2011-01-17 00:00:00', 'UTC'),
                'author' => 'Mark Gerhard and the RuneScape Team',
                'legacy_path' => '_legacy/services/m=news/newsitem-id-3889.html',
            ],
        ];

        foreach ($entries as $entry) {
            $body = $this->extractBody($entry['legacy_path']) ?? '<p>(Body unavailable in archive.)</p>';

            NewsItem::query()->updateOrCreate(
                ['slug' => $entry['slug']],
                [
                    'legacy_id' => $entry['legacy_id'],
                    'title' => $entry['title'],
                    'summary' => null,
                    'body_html' => $body,
                    'author' => $entry['author'],
                    'published_at' => $entry['published_at'],
                ],
            );
        }
    }

    private function extractBody(string $relative): ?string
    {
        $path = base_path($relative);
        if (! is_file($path)) {
            return null;
        }

        $html = file_get_contents($path);
        if ($html === false) {
            return null;
        }

        $crawler = new Crawler($html);
        $node = $crawler->filter('div.newsJustify');

        return $node->count() > 0 ? trim($node->first()->html()) : null;
    }
}
