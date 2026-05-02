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
require __DIR__.'/modules/legal.php';
