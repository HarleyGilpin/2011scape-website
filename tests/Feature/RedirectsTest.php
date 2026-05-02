<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RedirectsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Every legacy 2011 URL we care about must 301 to its canonical clean target.
     *
     * @return iterable<string, array{0: string, 1: string}>
     */
    public static function legacyUrls(): iterable
    {
        // Root pages
        yield 'wilderness.html' => ['/wilderness.html', '/wilderness'];
        yield 'parents.html' => ['/parents.html', '/parents'];
        yield 'cookies.html' => ['/cookies.html', '/cookies'];
        yield 'account_management.html' => ['/account_management.html', '/account-management'];
        yield 'golden_joystick.html' => ['/golden_joystick.html', '/golden-joystick'];
        yield 'options.html' => ['/options.html', '/options'];
        yield 'splash.html' => ['/splash.html', '/splash'];
        yield 'splash-media-1.html' => ['/splash-media-1.html', '/splash'];

        // Game launcher
        yield 'game.html' => ['/game.html', '/play'];
        yield 'game-autocreate-true.html' => ['/game-autocreate-true.html', '/play'];
        yield 'classicapplet/playclassic.html' => ['/classicapplet/playclassic.html', '/play/classic'];
        yield 'world8/,j0,f13.html' => ['/world8/,j0,f13.html', '/play'];

        // Auth + members
        yield 'loginform' => ['/secure/m=weblogin/loginform.html', '/login'];
        yield 'members' => ['/secure/m=weblogin/members/members.html', '/members'];
        yield 'displaynames' => ['/secure/m=displaynames/name.html', '/account/displayname'];

        // Billing + ticketing
        yield 'paymentoptions' => ['/secure/m=billing_core/paymentoptions.html', '/billing/paymentoptions'];
        yield 'unsubscribe' => ['/secure/m=billing_core/unsubscribe.html', '/billing/unsubscribe'];
        yield 'support' => ['/secure/m=ticketing/billingsupport.html', '/support'];
        yield 'support-cat-7' => ['/secure/m=ticketing/billingsupport-cat-7.html', '/support/7'];

        // News + devblog + KB
        yield 'news index' => ['/services/m=news/index.html', '/news'];
        yield 'news.rss' => ['/services/m=news/latest_news.rss', '/news.rss'];
        yield 'news article' => ['/services/m=news/the-wilderness-and-free-trade-will-return.html', '/news/the-wilderness-and-free-trade-will-return'];
        yield 'devblog index' => ['/services/m=devblog/index.html', '/devblog'];
        yield 'kb search' => ['/kbase/search.html', '/kb'];
        yield 'kb article' => ['/kbase/guid/10th_anniversary.html', '/kb/10th_anniversary'];
        yield 'kb category' => ['/kbase/view-guid-customer_support.html', '/kb/category/customer_support'];

        // Game services
        yield 'hiscores' => ['/services/m=hiscore/ranking.ws', '/hiscores'];
        yield 'item view' => ['/services/m=itemdb_rs/viewitem.ws?obj=9747', '/items/9747'];
        yield 'adventurer' => ['/services/m=adventurers-log/a=Zezima/main.ws', '/adventurer/Zezima'];

        // Legal
        yield 'terms.html' => ['/terms/terms.html', '/terms'];
        yield 'terms/eu.html' => ['/terms/eu.html', '/terms/eu'];
        yield 'rules.html' => ['/rules/rule_account_sharing.html', '/rules/rule_account_sharing'];
        yield 'privacy.html' => ['/privacy/privacy.html', '/privacy'];
    }

    /** @dataProvider legacyUrls */
    public function test_legacy_url_redirects_301(string $from, string $to): void
    {
        $response = $this->get($from);
        $response->assertStatus(301);
        $response->assertRedirect($to);
    }

    public function test_forum_path_is_not_redirected_by_laravel(): void
    {
        // /services/m=forum/ is handled by Apache `Alias`, not Laravel.
        // Laravel has no route for it; in tests it 404s (expected; Apache supplies it in production).
        $this->get('/services/m=forum/')->assertNotFound();
    }
}
