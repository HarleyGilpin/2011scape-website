<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_form_renders_jagex_chrome(): void
    {
        $response = $this->get('/secure/m=weblogin/loginform.html');

        $response->assertOk();
        $response->assertSee('id="login_form"', escape: false);
        $response->assertSee('id="login_panel"', escape: false);
        $response->assertSee('id="login_background"', escape: false);
        $response->assertSee('class="brown_background"', escape: false);
        $response->assertSee('id="usernameSection"', escape: false);
        $response->assertSee('id="passwordSection"', escape: false);
        $response->assertSee('name="_token"', escape: false);
        $response->assertSee('/css/global-38.css', escape: false);
        $response->assertSee('/css/weblogin-9.css', escape: false);
    }

    public function test_login_with_correct_credentials_redirects_to_members(): void
    {
        $response = $this->post('/secure/m=weblogin/login.html', [
            'username' => 'Zezima',
            'password' => 'Hunter2!',
            'mod' => 'www',
            'ssl' => '1',
            'dest' => '',
        ]);

        $response->assertRedirect('/secure/m=weblogin/members/members.html');
        $this->assertAuthenticated();
    }

    public function test_login_is_case_insensitive(): void
    {
        $this->post('/secure/m=weblogin/login.html', [
            'username' => 'ZEZIMA',
            'password' => 'Hunter2!',
        ])->assertRedirect('/secure/m=weblogin/members/members.html');

        $this->assertAuthenticated();
    }

    public function test_login_with_wrong_password_fails(): void
    {
        $response = $this->from('/secure/m=weblogin/loginform.html')
            ->post('/secure/m=weblogin/login.html', [
                'username' => 'Zezima',
                'password' => 'wrong',
            ]);

        $response->assertRedirect('/secure/m=weblogin/loginform.html');
        $response->assertSessionHasErrors('username');
        $this->assertGuest();
    }

    public function test_members_page_requires_auth(): void
    {
        $this->get('/secure/m=weblogin/members/members.html')->assertRedirect();
    }

    public function test_authenticated_user_sees_display_name(): void
    {
        $user = \App\Models\GameAccount::query()->whereRaw('LOWER(name) = ?', ['zezima'])->first();
        $this->assertNotNull($user, 'Zezima fixture missing from game DB');

        $this->actingAs($user)
            ->get('/secure/m=weblogin/members/members.html')
            ->assertOk()
            ->assertSee('Welcome, <strong>Zezima</strong>', escape: false);
    }
}
