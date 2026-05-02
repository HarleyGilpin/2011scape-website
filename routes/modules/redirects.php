<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Legacy URL 301 redirects
|--------------------------------------------------------------------------
| Loaded LAST in routes/web.php so canonical clean URLs always match first.
| Every legacy 2011 URL we know about redirects to its modern target so
| forum links, Google results, and bookmarks never 404.
|
| Forum (`/services/m=forum/*`) is handled by the Apache `Alias` and never
| reaches Laravel — do not list it here.
*/

$exact = [
    // Root pages
    '/wilderness.html' => '/wilderness',
    '/parents.html' => '/parents',
    '/cookies.html' => '/cookies',
    '/account_management.html' => '/account-management',
    '/competition_details.html' => '/competition-details',
    '/golden_joystick.html' => '/golden-joystick',
    '/options.html' => '/options',
    '/email_registration.html' => '/email-registration',
    '/splash.html' => '/splash',
    '/splash-media-1.html' => '/splash',
    '/splash-media-2.html' => '/splash',
    '/title-nosplash-1.html' => '/title-nosplash',
    '/title_video_popup.html' => '/title-video-popup',
    '/slu-j-0.html' => '/slu',

    // Game launcher
    '/game.html' => '/play',
    '/game-autocreate-true.html' => '/play',
    '/classicapplet/playclassic.html' => '/play/classic',

    // Auth + members
    '/secure/m=weblogin/loginform.html' => '/login',
    '/secure/m=weblogin/login.html' => '/login',
    '/secure/m=weblogin/logout.html' => '/logout',
    '/secure/m=weblogin/members/members.html' => '/members',
    '/secure/m=displaynames/name.html' => '/account/displayname',
    '/secure/m=ticketing/billingsupport.html' => '/support',

    // Billing
    '/secure/m=billing_core/paymentoptions.html' => '/billing/paymentoptions',
    '/secure/m=billing_core/unsubscribe.html' => '/billing/unsubscribe',
    '/secure/m=billing_core/userdetails.html' => '/billing/userdetails',

    // News + devblog + KB landings
    '/services/m=news/index.html' => '/news',
    '/services/m=news/latest_news.rss' => '/news.rss',
    '/services/m=devblog/index.html' => '/devblog',
    '/kbase/search.html' => '/kb',

    // Game services
    '/services/m=hiscore/ranking.ws' => '/hiscores',
    '/services/m=hiscore/index.html' => '/hiscores',
    '/services/m=hiscore/hiscores.html' => '/hiscores',
    '/services/m=itemdb_rs/frontpage.html' => '/items',
    '/services/m=adventurers-log/display_player_profile.html' => '/hiscores',
    '/secure/m=account-recovery/' => '/recover',
    '/secure/m=account-recovery' => '/recover',

    // Legal landings
    '/terms/terms.html' => '/terms',
    '/privacy/privacy.html' => '/privacy',
    '/kbase/guid/rules_of_conduct.html' => '/rules',
    '/kbase/guid/Customer_Support.html' => '/support',
];

foreach ($exact as $from => $to) {
    Route::any($from, fn () => redirect($to, 301));
}

// Pattern-based redirects
Route::get('/services/m=news/{slug}.html', fn (string $slug) => redirect('/news/'.$slug, 301))
    ->where('slug', '[A-Za-z0-9_\-]+');

Route::get('/services/m=devblog/{slug}.html', fn (string $slug) => redirect('/devblog/'.$slug, 301))
    ->where('slug', '[A-Za-z0-9_\-]+');

Route::get('/kbase/guid/{slug}.html', fn (string $slug) => redirect('/kb/'.$slug, 301))
    ->where('slug', '[A-Za-z0-9_\-]+');

Route::get('/kbase/view-guid-{slug}.html', fn (string $slug) => redirect('/kb/category/'.$slug, 301))
    ->where('slug', '[A-Za-z0-9_\-]+');

Route::get('/services/m=adventurers-log/a={user}/main.ws', fn (string $user) => redirect('/adventurer/'.$user, 301))
    ->where('user', '[A-Za-z0-9_+\-]+');

Route::get('/services/m=itemdb_rs/viewitem.ws', function (Request $request) {
    $obj = (string) $request->query('obj', '');
    return $obj !== '' ? redirect('/items/'.$obj, 301) : redirect('/items', 301);
});

Route::get('/services/m=itemdb_rs/{any}', fn () => redirect('/items', 301))->where('any', '.*');

Route::get('/secure/m=ticketing/billingsupport-cat-{cat}.html', fn (string $cat) => redirect('/support/'.$cat, 301))
    ->where('cat', '[0-9]+');

Route::get('/terms/{slug}.html', fn (string $slug) => redirect('/terms/'.$slug, 301))
    ->where('slug', '[A-Za-z0-9_\-]+');

Route::get('/rules/{slug}.html', fn (string $slug) => redirect('/rules/'.$slug, 301))
    ->where('slug', '[A-Za-z0-9_\-]+');

Route::get('/privacy/{slug}.html', fn (string $slug) => redirect('/privacy', 301))
    ->where('slug', '[A-Za-z0-9_\-]+');

// World launcher links: /world8/,j0,f13.html → /play
Route::get('/world{n}/{stub}', fn () => redirect('/play', 301))
    ->where(['n' => '8|14', 'stub' => '.*']);
