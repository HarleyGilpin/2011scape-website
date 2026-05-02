<?php

use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;

Route::get('services/m=news/latest_news.rss', [NewsController::class, 'rss'])->name('news.rss');
Route::get('services/m=news/index.html', [NewsController::class, 'index'])->name('news.index');
Route::get('services/m=news/{slug}.html', [NewsController::class, 'show'])
    ->where('slug', '[A-Za-z0-9_\-]+')
    ->name('news.show');
