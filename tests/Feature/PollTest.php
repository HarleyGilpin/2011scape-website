<?php

namespace Tests\Feature;

use App\Models\Poll;
use App\Models\PollOption;
use App\Models\PollVote;
use Database\Seeders\PollsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PollTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(PollsSeeder::class);
    }

    public function test_homepage_shows_active_poll_form(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('id="poll"', escape: false)
            ->assertSeeText('When are you planning to take on Nex?')
            ->assertSee('name="option_id"', escape: false);
    }

    public function test_vote_increments_count_and_redirects(): void
    {
        $poll = Poll::query()->where('active', true)->firstOrFail();
        $option = $poll->options()->first();

        $this->assertSame(0, (int) $option->vote_count);

        $this->post('/polls/'.$poll->id.'/vote', ['option_id' => $option->id])
            ->assertRedirect();

        $this->assertSame(1, (int) $option->fresh()->vote_count);
        $this->assertSame(1, PollVote::query()->where('poll_id', $poll->id)->count());
    }

    public function test_revisit_after_vote_shows_results_not_form(): void
    {
        $poll = Poll::query()->where('active', true)->firstOrFail();
        $option = $poll->options()->first();

        $session = $this->withSession([])->withCookie('voter_token', 'guest:'.str_repeat('a', 40));
        $session->post('/polls/'.$poll->id.'/vote', ['option_id' => $option->id])
            ->assertRedirect();

        $this->withCookie('voter_token', 'guest:'.str_repeat('a', 40))
            ->get('/')
            ->assertOk()
            ->assertSee('class="poll-bar"', escape: false)
            ->assertDontSee('name="option_id"', escape: false);
    }

    public function test_double_vote_rejected(): void
    {
        $poll = Poll::query()->where('active', true)->firstOrFail();
        $option = $poll->options()->first();

        $token = 'guest:'.str_repeat('b', 40);

        $this->withCookie('voter_token', $token)
            ->post('/polls/'.$poll->id.'/vote', ['option_id' => $option->id])
            ->assertRedirect();

        $before = (int) $option->fresh()->vote_count;

        $this->withCookie('voter_token', $token)
            ->post('/polls/'.$poll->id.'/vote', ['option_id' => $option->id])
            ->assertRedirect()
            ->assertSessionHas('poll_status', 'You have already voted in this poll.');

        $this->assertSame($before, (int) $option->fresh()->vote_count);
    }

    public function test_invalid_option_rejected(): void
    {
        $poll = Poll::query()->where('active', true)->firstOrFail();

        $this->post('/polls/'.$poll->id.'/vote', ['option_id' => 99999])
            ->assertRedirect()
            ->assertSessionHas('poll_status', 'Invalid option.');

        $this->assertSame(0, PollVote::query()->where('poll_id', $poll->id)->count());
    }

    public function test_inactive_poll_rejects_votes(): void
    {
        $poll = Poll::query()->where('active', true)->firstOrFail();
        $poll->update(['active' => false]);
        $option = $poll->options()->first();

        $this->post('/polls/'.$poll->id.'/vote', ['option_id' => $option->id])
            ->assertRedirect()
            ->assertSessionHas('poll_status', 'This poll is closed.');

        $this->assertSame(0, PollVote::query()->where('poll_id', $poll->id)->count());
    }
}
