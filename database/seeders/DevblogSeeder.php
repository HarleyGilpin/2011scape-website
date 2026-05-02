<?php

namespace Database\Seeders;

use App\Models\DevblogPost;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class DevblogSeeder extends Seeder
{
    public function run(): void
    {
        $entries = [
            [
                'slug' => 'welcome-to-2011scape',
                'title' => 'Welcome to 2011scape',
                'author' => 'The 2011scape Team',
                'published_at' => Carbon::parse('2026-01-01 00:00:00', 'UTC'),
                'hero_image' => '/services/m=devblog/images/icon/dev-1.png',
                'body_html' => <<<'HTML'
<p>Welcome to <strong>2011scape</strong> — a community-built archive of the RuneScape we all remember.</p>
<p>This dev blog is where we'll share progress on the emulator, the website, and the community events that bring us back to 2011.</p>
<p>Stay tuned for posts on engine internals, Grand Exchange repricing, the upcoming Wilderness restoration, and more.</p>
HTML,
            ],
            [
                'slug' => 'engine-internals-part-1',
                'title' => 'Engine Internals: Part 1',
                'author' => 'Mod Dev',
                'published_at' => Carbon::parse('2026-02-15 00:00:00', 'UTC'),
                'hero_image' => '/services/m=devblog/images/icon/qna-1.png',
                'body_html' => <<<'HTML'
<p>Mod Dev gives a behind-the-scenes look at how the void engine handles tile rendering, NPC scripting, and player movement.</p>
<p>This post is part one of a deep-dive series. Part two covers combat formulas; part three covers the Grand Exchange engine.</p>
HTML,
            ],
            [
                'slug' => 'grand-exchange-repricing',
                'title' => 'Grand Exchange Repricing',
                'author' => 'Mod GE',
                'published_at' => Carbon::parse('2026-03-10 00:00:00', 'UTC'),
                'hero_image' => '/services/m=devblog/images/icon/manage-1.png',
                'body_html' => <<<'HTML'
<p>The Grand Exchange has been quietly recalibrating since our launch. We've now collected enough trade data to set baseline prices for over 10,000 items.</p>
<p>Read on for how the algorithm works, why some items dipped sharply, and what to expect over the next month as the market stabilises.</p>
HTML,
            ],
            [
                'slug' => 'wilderness-restoration',
                'title' => 'Wilderness Restoration',
                'author' => 'Mod World',
                'published_at' => Carbon::parse('2026-04-20 00:00:00', 'UTC'),
                'hero_image' => '/services/m=devblog/images/icon/design-1.png',
                'body_html' => <<<'HTML'
<p>Following the community vote, the Wilderness is coming back in full. PKers, get ready.</p>
<p>This post covers the timeline (rolling out next week), the items being un-blocked from free trade, and how clan wars and bounty hunter will interact.</p>
HTML,
            ],
        ];

        foreach ($entries as $entry) {
            DevblogPost::query()->updateOrCreate(['slug' => $entry['slug']], $entry);
        }
    }
}
