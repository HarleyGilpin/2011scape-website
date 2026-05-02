<?php

use App\Http\Controllers\LegacyPageController;
use Illuminate\Support\Facades\Route;

$rootPages = [
    'wilderness.html',
    'account_management.html',
    'competition_details.html',
    'golden_joystick.html',
    'options.html',
    'parents.html',
    'cookies.html',
    'email_registration.html',
    'splash.html',
    'splash-media-1.html',
    'splash-media-2.html',
    'title-nosplash-1.html',
    'title_video_popup.html',
    'slu-j-0.html',
];

foreach ($rootPages as $page) {
    Route::get($page, fn () => app(LegacyPageController::class)->show($page));
}

Route::get('terms/{page}.html', fn (string $page) => app(LegacyPageController::class)->show('terms/'.$page.'.html'))
    ->where('page', '[A-Za-z0-9_\-]+');
Route::get('rules/{page}.html', fn (string $page) => app(LegacyPageController::class)->show('rules/'.$page.'.html'))
    ->where('page', '[A-Za-z0-9_\-]+');
Route::get('privacy/{page}.html', fn (string $page) => app(LegacyPageController::class)->show('privacy/'.$page.'.html'))
    ->where('page', '[A-Za-z0-9_\-]+');
