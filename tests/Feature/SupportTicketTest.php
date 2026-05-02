<?php

namespace Tests\Feature;

use App\Models\GameAccount;
use App\Models\SupportTicket;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SupportTicketTest extends TestCase
{
    use RefreshDatabase;

    private GameAccount $user;

    protected function setUp(): void
    {
        parent::setUp();
        $user = GameAccount::query()->whereRaw('LOWER(name) = ?', ['zezima'])->first();
        $this->assertNotNull($user, 'Zezima fixture missing');
        $this->user = $user;
    }

    public function test_create_form_requires_auth(): void
    {
        $this->get('/support/new')->assertRedirect();
    }

    public function test_authenticated_user_sees_form(): void
    {
        $this->actingAs($this->user)
            ->get('/support/new')
            ->assertOk()
            ->assertSee('name="category"', escape: false)
            ->assertSee('name="subject"', escape: false)
            ->assertSee('name="body"', escape: false);
    }

    public function test_valid_submit_creates_ticket(): void
    {
        $response = $this->actingAs($this->user)
            ->post('/support', [
                'category' => 'gameplay',
                'subject' => 'Cannot find Lumbridge',
                'body' => 'I keep ending up in Varrock. Help.',
            ]);

        $response->assertRedirect('/support/thanks');

        $this->assertDatabaseHas('support_tickets', [
            'user_account_id' => $this->user->getKey(),
            'category' => 'gameplay',
            'subject' => 'Cannot find Lumbridge',
            'status' => 'open',
        ]);
    }

    public function test_invalid_category_rejected(): void
    {
        $this->actingAs($this->user)
            ->from('/support/new')
            ->post('/support', [
                'category' => 'foo',
                'subject' => 'x',
                'body' => 'y',
            ])
            ->assertRedirect('/support/new')
            ->assertSessionHasErrors('category');

        $this->assertSame(0, SupportTicket::query()->where('user_account_id', $this->user->getKey())->count());
    }

    public function test_thanks_page_renders(): void
    {
        $this->actingAs($this->user)->get('/support/thanks')->assertOk()->assertSeeText('Thanks');
    }
}
