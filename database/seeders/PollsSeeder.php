<?php

namespace Database\Seeders;

use App\Models\Poll;
use App\Models\PollOption;
use Illuminate\Database\Seeder;

class PollsSeeder extends Seeder
{
    public function run(): void
    {
        $poll = Poll::query()->updateOrCreate(
            ['question' => 'When are you planning to take on Nex?'],
            ['active' => true],
        );

        $options = [
            'Already done — I have bruises!',
            'When more people have tried',
            'Soon — I\'m getting ready!',
            'When I can get a decent team together',
            'Not for me — I\'m a Skiller, not a killer!',
        ];

        foreach ($options as $i => $label) {
            PollOption::query()->updateOrCreate(
                ['poll_id' => $poll->id, 'position' => $i],
                ['label' => $label],
            );
        }
    }
}
