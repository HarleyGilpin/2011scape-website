<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

require __DIR__.'/modules/auth.php';
require __DIR__.'/modules/news.php';
require __DIR__.'/modules/devblog.php';
require __DIR__.'/modules/kb.php';
require __DIR__.'/modules/billing.php';
require __DIR__.'/modules/services.php';
require __DIR__.'/modules/gamelaunch.php';
require __DIR__.'/modules/pages.php';
require __DIR__.'/modules/legal.php';

Route::post('/polls/{poll}/vote', [App\Http\Controllers\PollController::class, 'vote'])
    ->name('polls.vote');

// MUST be loaded last — legacy 301s should never override canonical routes.
require __DIR__.'/modules/redirects.php';
