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
                'summary' => null,
                'body' => null,
            ],
            [
                'legacy_id' => null,
                'slug' => '2011scape-launch',
                'title' => '2011scape is now live',
                'published_at' => Carbon::parse('2026-01-01 00:00:00', 'UTC'),
                'author' => 'The 2011scape Team',
                'legacy_path' => null,
                'summary' => 'After months of restoration work the 2011scape archive is open to the public. Membership is free; everything you remember is here.',
                'body' => '<p>After months of restoration work the <strong>2011scape</strong> archive is open to the public.</p><p>Membership is free; everything you remember is here. Forums, hiscores, the full knowledge base, and the original game launcher are all wired up. Join the forums for support and announcements.</p>',
            ],
            [
                'legacy_id' => null,
                'slug' => 'item-database-online',
                'title' => 'Item Database now searchable',
                'published_at' => Carbon::parse('2026-03-01 00:00:00', 'UTC'),
                'author' => 'Mod GE',
                'legacy_path' => null,
                'summary' => '10,171 item definitions are now searchable from the website. Look up examines, members status, and tradeable flags for every item in the cache.',
                'body' => '<p>The full item cache is now indexed and searchable from <a href="/items">the Item Database</a>. 10,171 items, every examine string, every slot, every tradeable flag.</p><p>Tied to the void cache so it stays in sync with the game.</p>',
            ],
        ];

        foreach ($entries as $entry) {
            $body = $entry['body']
                ?? $this->extractBody($entry['legacy_path'])
                ?? '<p>(Body unavailable in archive.)</p>';

            NewsItem::query()->updateOrCreate(
                ['slug' => $entry['slug']],
                [
                    'legacy_id' => $entry['legacy_id'],
                    'title' => $entry['title'],
                    'summary' => $entry['summary'],
                    'body_html' => $body,
                    'author' => $entry['author'],
                    'published_at' => $entry['published_at'],
                ],
            );
        }
    }

    private function extractBody(?string $relative): ?string
    {
        if ($relative === null) {
            return null;
        }

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
