<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SmokeTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Every legacy URL we publicly expose must respond 200 with no exceptions.
     *
     * @return iterable<string, array{0: string}>
     */
    public static function urls(): iterable
    {
        yield '/' => ['/'];
        yield '/wilderness.html' => ['/wilderness.html'];
        yield '/parents.html' => ['/parents.html'];
        yield '/cookies.html' => ['/cookies.html'];
        yield '/terms/eu.html' => ['/terms/eu.html'];
        yield '/rules/rule_account_sharing.html' => ['/rules/rule_account_sharing.html'];
        yield '/privacy/privacy.html' => ['/privacy/privacy.html'];
        yield '/secure/m=weblogin/loginform.html' => ['/secure/m=weblogin/loginform.html'];
        yield '/services/m=news/latest_news.rss' => ['/services/m=news/latest_news.rss'];
        yield '/secure/m=billing_core/paymentoptions.html' => ['/secure/m=billing_core/paymentoptions.html'];
        yield '/classicapplet/playclassic.html' => ['/classicapplet/playclassic.html'];
        yield '/world8/,j0,f13.html' => ['/world8/,j0,f13.html'];
        yield '/services/m=hiscore/ranking.ws' => ['/services/m=hiscore/ranking.ws'];
        yield '/services/m=hiscore/ranking.ws?skill=attack' => ['/services/m=hiscore/ranking.ws?skill=attack'];
        yield '/services/m=devblog/index.html' => ['/services/m=devblog/index.html'];
        yield '/game.html' => ['/game.html'];
    }

    /** @dataProvider urls */
    public function test_legacy_url_returns_200(string $url): void
    {
        $this->get($url)->assertOk();
    }

    public function test_unknown_legacy_path_returns_404(): void
    {
        $this->get('/services/m=billing_core/does_not_exist.html')->assertNotFound();
    }

    public function test_path_traversal_in_legacy_controller_blocked(): void
    {
        $this->get('/wilderness.html/../../etc/passwd')->assertNotFound();
    }
}
