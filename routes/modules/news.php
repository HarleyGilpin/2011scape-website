<?php

use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;

Route::get('/news.rss', [NewsController::class, 'rss'])->name('news.rss');
Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/{slug}', [NewsController::class, 'show'])
    ->where('slug', '[A-Za-z0-9_\-]+')
    ->name('news.show');
