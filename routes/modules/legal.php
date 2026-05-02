<?php

use Illuminate\Support\Facades\Route;

foreach ([
    'wilderness.html' => 'pages.wilderness',
    'account_management.html' => 'pages.account_management',
    'competition_details.html' => 'pages.competition_details',
    'golden_joystick.html' => 'pages.golden_joystick',
    'options.html' => 'pages.options',
    'parents.html' => 'pages.parents',
    'cookies.html' => 'pages.cookies',
    'email_registration.html' => 'pages.email_registration',
    'splash.html' => 'pages.splash',
    'splash-media-1.html' => 'pages.splash',
    'splash-media-2.html' => 'pages.splash',
    'title-nosplash-1.html' => 'pages.title_nosplash',
    'title_video_popup.html' => 'pages.title_video_popup',
    'slu-j-0.html' => 'pages.slu',
] as $path => $view) {
    Route::view($path, $view);
}

Route::get('terms/{page}.html', fn (string $page) => view('legal.terms', ['page' => $page]))
    ->where('page', '[A-Za-z0-9_\-]+');
Route::get('rules/{page}.html', fn (string $page) => view('legal.rules', ['page' => $page]))
    ->where('page', '[A-Za-z0-9_\-]+');
Route::get('privacy/{page}.html', fn (string $page) => view('legal.privacy', ['page' => $page]))
    ->where('page', '[A-Za-z0-9_\-]+');
