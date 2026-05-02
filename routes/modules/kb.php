<?php

use App\Http\Controllers\KbaseController;
use Illuminate\Support\Facades\Route;

Route::get('/kb', [KbaseController::class, 'search'])->name('kb.search');
Route::get('/kb/category/{slug}', [KbaseController::class, 'category'])
    ->where('slug', '[A-Za-z0-9_\-]+')
    ->name('kb.category');
Route::get('/kb/{slug}', [KbaseController::class, 'show'])
    ->where('slug', '[A-Za-z0-9_\-]+')
    ->name('kb.show');
