<?php

namespace Tests\Feature;

use App\Models\DisplaynameChange;
use App\Models\GameAccount;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class DisplaynameTest extends TestCase
{
    use RefreshDatabase;

    private GameAccount $user;
    private string $originalDisplayName;

    protected function setUp(): void
    {
        parent::setUp();

        $user = GameAccount::query()->whereRaw('LOWER(name) = ?', ['zezima'])->first();
        $this->assertNotNull($user, 'Zezima fixture missing from game DB');
        $this->user = $user;

        $row = DB::connection('pgsql_game')
            ->table('variables')
            ->where('player_id', $this->user->getKey())
            ->where('name', 'display_name')
            ->first();
        $this->originalDisplayName = (string) ($row->string_value ?? $this->user->name());
    }

    protected function tearDown(): void
    {
        DB::connection('pgsql_game_writer')
            ->table('variables')
            ->where('player_id', $this->user->getKey())
            ->where('name', 'display_name')
            ->update(['string_value' => $this->originalDisplayName]);

        parent::tearDown();
    }

    public function test_form_requires_auth(): void
    {
        $this->get('/secure/m=displaynames/name.html')->assertRedirect();
    }

    public function test_authenticated_user_sees_form(): void
    {
        $this->actingAs($this->user)
            ->get('/secure/m=displaynames/name.html')
            ->assertOk()
            ->assertSeeText('Change Display Name')
            ->assertSee('name="new_name"', escape: false);
    }

    public function test_submit_writes_variable_and_audit_row(): void
    {
        $newName = 'TestZezima';

        $response = $this->actingAs($this->user)
            ->post('/secure/m=displaynames/name.html', ['new_name' => $newName]);

        $response->assertRedirect('/secure/m=displaynames/name.html');
        $response->assertSessionHas('status');

        $this->assertDatabaseHas('displayname_changes', [
            'user_account_id' => $this->user->getKey(),
            'new_name' => $newName,
            'status' => 'applied',
        ]);

        $row = DB::connection('pgsql_game')
            ->table('variables')
            ->where('player_id', $this->user->getKey())
            ->where('name', 'display_name')
            ->first();
        $this->assertNotNull($row);
        $this->assertSame($newName, $row->string_value);
        $this->assertSame(6, (int) $row->type);
    }

    public function test_invalid_format_rejected(): void
    {
        $this->actingAs($this->user)
            ->from('/secure/m=displaynames/name.html')
            ->post('/secure/m=displaynames/name.html', ['new_name' => 'has!bang'])
            ->assertSessionHasErrors('new_name');
    }

    public function test_collision_with_existing_account_rejected(): void
    {
        DB::connection('pgsql_game_writer')->table('accounts')->insert([
            'name' => 'Cabbage',
            'password_hash' => '$2y$04$abcabcabcabcabcabcabcuabcabcabcabcabcabcabcabcabcabcabcab',
            'tile' => 0, 'blocked' => '{}', 'male' => true,
            'looks' => '{}', 'colours' => '{}',
            'friends' => '{}', 'ranks' => '{}', 'ignores' => '{}',
        ]);

        try {
            $this->actingAs($this->user)
                ->from('/secure/m=displaynames/name.html')
                ->post('/secure/m=displaynames/name.html', ['new_name' => 'Cabbage'])
                ->assertSessionHasErrors('new_name');

            $this->assertDatabaseMissing('displayname_changes', [
                'user_account_id' => $this->user->getKey(),
                'new_name' => 'Cabbage',
            ]);
        } finally {
            DB::connection('pgsql_game_writer')->table('accounts')->where('name', 'Cabbage')->delete();
        }
    }
}
