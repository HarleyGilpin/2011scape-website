<?php

use Illuminate\Support\Facades\Route;

// Static page Blades extracted from _legacy/ via `php artisan legacy:extract`.
foreach ([
    '/wilderness' => 'pages.wilderness',
    '/parents' => 'pages.parents',
    '/cookies' => 'pages.cookies',
    '/account-management' => 'pages.account_management',
    '/competition-details' => 'pages.competition_details',
    '/golden-joystick' => 'pages.golden_joystick',
    '/options' => 'pages.options',
    '/email-registration' => 'pages.email_registration',
    '/splash' => 'pages.splash',
    '/title-nosplash' => 'pages.title_nosplash_1',
    '/title-video-popup' => 'pages.title_video_popup',
    '/slu' => 'pages.slu_j_0',
] as $url => $view) {
    Route::view($url, $view);
}
