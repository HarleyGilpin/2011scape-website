<?php

namespace Tests\Feature;

use App\Repositories\HiscoresRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HiscoresTest extends TestCase
{
    use RefreshDatabase;

    public function test_overall_ranking_renders_zezima(): void
    {
        $response = $this->get('/hiscores');

        $response->assertOk();
        $response->assertSeeText('Zezima');
        $response->assertSee('39,103,293');
    }

    public function test_per_skill_ranking_renders(): void
    {
        $response = $this->get('/hiscores?skill=attack');

        $response->assertOk();
        $response->assertSeeText('Attack');
        $response->assertSeeText('Zezima');
    }

    public function test_unknown_skill_falls_back_to_overall(): void
    {
        $this->get('/hiscores?skill=bogus')
            ->assertOk()
            ->assertSeeText('Overall');
    }

    public function test_repository_finds_rank_for_user(): void
    {
        $rank = app(HiscoresRepository::class)->rankFor('zezima', 'attack');

        $this->assertNotNull($rank);
        $this->assertSame(1, (int) $rank->rank);
    }
}
