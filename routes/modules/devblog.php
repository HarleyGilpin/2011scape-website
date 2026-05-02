<?php

use App\Http\Controllers\DevblogController;
use Illuminate\Support\Facades\Route;

Route::get('/devblog', [DevblogController::class, 'index'])->name('devblog.index');
Route::get('/devblog/{slug}', [DevblogController::class, 'show'])
    ->where('slug', '[A-Za-z0-9_\-]+')
    ->name('devblog.show');
