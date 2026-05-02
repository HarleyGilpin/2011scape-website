<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SmokeTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Canonical clean URLs must respond 200.
     *
     * @return iterable<string, array{0: string}>
     */
    public static function urls(): iterable
    {
        yield '/' => ['/'];
        yield '/wilderness' => ['/wilderness'];
        yield '/parents' => ['/parents'];
        yield '/cookies' => ['/cookies'];
        yield '/account-management' => ['/account-management'];
        yield '/golden-joystick' => ['/golden-joystick'];
        yield '/competition-details' => ['/competition-details'];
        yield '/options' => ['/options'];
        yield '/email-registration' => ['/email-registration'];
        yield '/splash' => ['/splash'];
        yield '/terms' => ['/terms'];
        yield '/terms/eu' => ['/terms/eu'];
        yield '/rules' => ['/rules'];
        yield '/rules/account-sharing' => ['/rules/account-sharing'];
        yield '/privacy' => ['/privacy'];
        yield '/login' => ['/login'];
        yield '/news.rss' => ['/news.rss'];
        yield '/billing/paymentoptions' => ['/billing/paymentoptions'];
        yield '/play' => ['/play'];
        yield '/play/classic' => ['/play/classic'];
        yield '/hiscores' => ['/hiscores'];
        yield '/hiscores?skill=attack' => ['/hiscores?skill=attack'];
        yield '/devblog' => ['/devblog'];
    }

    /** @dataProvider urls */
    public function test_canonical_url_returns_200(string $url): void
    {
        $this->get($url)->assertOk();
    }
}
