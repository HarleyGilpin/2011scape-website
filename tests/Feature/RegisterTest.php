<?php

namespace Tests\Feature;

use App\Models\GameAccount;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    protected function tearDown(): void
    {
        $accounts = DB::connection('pgsql_game_writer')
            ->table('accounts')
            ->whereIn('name', ['NewBob', 'CaseTester'])
            ->get();

        foreach ($accounts as $acc) {
            DB::connection('pgsql_game_writer')->table('experience')->where('player_id', $acc->id)->delete();
            DB::connection('pgsql_game_writer')->table('levels')->where('player_id', $acc->id)->delete();
            DB::connection('pgsql_game_writer')->table('variables')->where('player_id', $acc->id)->delete();
            DB::connection('pgsql_game_writer')->table('accounts')->where('id', $acc->id)->delete();
        }

        parent::tearDown();
    }

    public function test_register_form_renders_jagex_chrome(): void
    {
        $this->get('/register')
            ->assertOk()
            ->assertSee('id="login_panel"', escape: false)
            ->assertSee('class="brown_background"', escape: false)
            ->assertSee('name="name"', escape: false)
            ->assertSee('name="password_confirmation"', escape: false);
    }

    public function test_happy_path_creates_account_and_logs_user_in(): void
    {
        $response = $this->post('/register', [
            'name' => 'NewBob',
            'email' => 'bob@example.com',
            'password' => 'Hunter2!',
            'password_confirmation' => 'Hunter2!',
        ]);

        $response->assertRedirect('/members');
        $this->assertAuthenticated();

        $account = GameAccount::query()->whereRaw('LOWER(name) = ?', ['newbob'])->first();
        $this->assertNotNull($account);

        $this->assertSame('NewBob', $account->name);
        $this->assertTrue(password_verify('Hunter2!', $account->password_hash));

        $exp = DB::connection('pgsql_game')->table('experience')->where('player_id', $account->id)->first();
        $this->assertNotNull($exp);
        $this->assertSame(0, (int) $exp->attack);
        $this->assertSame(1154, (int) $exp->constitution);

        $lvl = DB::connection('pgsql_game')->table('levels')->where('player_id', $account->id)->first();
        $this->assertSame(1, (int) $lvl->attack);
        $this->assertSame(10, (int) $lvl->constitution);

        $dn = DB::connection('pgsql_game')->table('variables')
            ->where('player_id', $account->id)->where('name', 'display_name')->first();
        $this->assertSame('NewBob', $dn->string_value);

        $this->assertDatabaseHas('user_emails', [
            'user_account_id' => $account->id,
            'email' => 'bob@example.com',
        ]);
    }

    public function test_duplicate_name_case_insensitive_rejected(): void
    {
        // Zezima fixture exists already
        $this->from('/register')
            ->post('/register', [
                'name' => 'zezima',
                'password' => 'Hunter2!',
                'password_confirmation' => 'Hunter2!',
            ])
            ->assertRedirect('/register')
            ->assertSessionHasErrors('name');

        $this->assertGuest();
    }

    public function test_password_mismatch_rejected(): void
    {
        $this->from('/register')
            ->post('/register', [
                'name' => 'CaseTester',
                'password' => 'Hunter2!',
                'password_confirmation' => 'differentPW',
            ])
            ->assertRedirect('/register')
            ->assertSessionHasErrors('password');

        $this->assertGuest();
        $this->assertNull(GameAccount::query()->whereRaw('LOWER(name) = ?', ['casetester'])->first());
    }

    public function test_reserved_name_rejected(): void
    {
        $this->from('/register')
            ->post('/register', [
                'name' => 'admin',
                'password' => 'Hunter2!',
                'password_confirmation' => 'Hunter2!',
            ])
            ->assertRedirect('/register')
            ->assertSessionHasErrors('name');

        $this->assertGuest();
    }

    public function test_invalid_format_rejected(): void
    {
        $this->from('/register')
            ->post('/register', [
                'name' => 'has!bang',
                'password' => 'Hunter2!',
                'password_confirmation' => 'Hunter2!',
            ])
            ->assertRedirect('/register')
            ->assertSessionHasErrors('name');
    }
}
