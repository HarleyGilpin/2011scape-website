<?php

namespace Database\Seeders;

use App\Models\HotTopic;
use Illuminate\Database\Seeder;

class HotTopicsSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'position' => 10,
                'label' => 'Welcome to 2011scape',
                'image' => '/services/m=config-manager/hottopics/img/news_announcements_2.gif',
                'url' => '/services/m=forum/',
                'byline' => 'Posted by 2011scape Team',
            ],
            [
                'position' => 20,
                'label' => 'God Wars – The Ancient Prison',
                'image' => '/services/m=config-manager/hottopics/img/player_vs_monster.gif',
                'url' => '/kb/ancient_prison',
                'byline' => 'Knowledge Base',
            ],
            [
                'position' => 30,
                'label' => 'How to recover your account',
                'image' => '/services/m=config-manager/hottopics/img/tech_support_2.gif',
                'url' => '/support',
                'byline' => 'Customer Support',
            ],
            [
                'position' => 40,
                'label' => 'Dev Blog: behind the scenes',
                'image' => '/services/m=config-manager/hottopics/img/JL_icon.jpg',
                'url' => '/devblog',
                'byline' => 'Dev Team',
            ],
            [
                'position' => 50,
                'label' => 'Wilderness & Free Trade',
                'image' => '/services/m=config-manager/hottopics/img/duelling_2.gif',
                'url' => '/news/the-wilderness-and-free-trade-will-return',
                'byline' => 'News',
            ],
        ];

        foreach ($items as $row) {
            HotTopic::query()->updateOrCreate(['label' => $row['label']], $row);
        }
    }
}
