<?php

namespace Database\Seeders;

use App\Models\HotTopic;
use Illuminate\Database\Seeder;

class HotTopicsSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['position' => 10, 'label' => 'Knowledge Base', 'url' => '/kbase/search.html'],
            ['position' => 20, 'label' => 'Hiscores', 'url' => '/services/m=hiscore/ranking.ws'],
            ['position' => 30, 'label' => 'Forums', 'url' => '/services/m=forum/'],
            ['position' => 40, 'label' => 'Item DB', 'url' => '/services/m=itemdb_rs/'],
        ];

        foreach ($items as $row) {
            HotTopic::query()->updateOrCreate(['label' => $row['label']], $row);
        }
    }
}
