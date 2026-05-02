<?php

use App\Http\Controllers\KbaseController;
use Illuminate\Support\Facades\Route;

Route::get('kbase/search.html', [KbaseController::class, 'search'])->name('kbase.search');
Route::get('kbase/view-guid-{slug}.html', [KbaseController::class, 'category'])
    ->where('slug', '[A-Za-z0-9_\-]+')
    ->name('kbase.category');
Route::get('kbase/guid/{slug}.html', [KbaseController::class, 'show'])
    ->where('slug', '[A-Za-z0-9_\-]+')
    ->name('kbase.show');
