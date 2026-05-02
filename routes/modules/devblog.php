<?php

use App\Http\Controllers\DevblogController;
use Illuminate\Support\Facades\Route;

Route::get('services/m=devblog/index.html', [DevblogController::class, 'index'])->name('devblog.index');
Route::get('services/m=devblog/{slug}.html', [DevblogController::class, 'show'])
    ->where('slug', '[A-Za-z0-9_\-]+')
    ->name('devblog.show');
