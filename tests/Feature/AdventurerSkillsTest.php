<?php

namespace Tests\Feature;

use App\Models\GameAccount;
use App\Repositories\AdventurersLogRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdventurerSkillsTest extends TestCase
{
    use RefreshDatabase;

    public function test_skill_grid_renders_for_zezima(): void
    {
        $response = $this->get('/adventurer/Zezima');

        $response->assertOk();
        $response->assertSee('class="plaque">Zezima', escape: false);
        $response->assertSee('skill-grid', escape: false);
        $response->assertSeeText('Skill');
        $response->assertSeeText('Level');
        $response->assertSeeText('XP');
        $response->assertSeeText('Total');

        // Zezima fixture has attack/strength/defence at level 99 each, with XP 13,034,431 each
        $response->assertSee('39,103,293', escape: false);
    }

    public function test_unknown_user_404s(): void
    {
        $this->get('/adventurer/NobodyHere')->assertNotFound();
    }

    public function test_repository_returns_25_skills_for_zezima(): void
    {
        $user = GameAccount::query()->whereRaw('LOWER(name) = ?', ['zezima'])->first();
        $this->assertNotNull($user, 'Zezima fixture missing');

        $skills = app(AdventurersLogRepository::class)->skills((int) $user->getKey());
        $this->assertSame(25, $skills->count());

        $totals = app(AdventurersLogRepository::class)->totals($skills);
        $this->assertSame(39103293, $totals->xp);
    }
}
