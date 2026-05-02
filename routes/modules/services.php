<?php

use App\Http\Controllers\AdventurersLogController;
use App\Http\Controllers\HiscoresController;
use App\Http\Controllers\ItemDbController;
use Illuminate\Support\Facades\Route;

Route::get('/adventurer/{user}', [AdventurersLogController::class, 'show'])
    ->where('user', '[A-Za-z0-9_+\-]+')
    ->name('adventurer');

Route::get('/hiscores', [HiscoresController::class, 'ranking'])->name('hiscores');

Route::get('/items', [ItemDbController::class, 'search'])->name('items.search');
Route::get('/items/{id}', [ItemDbController::class, 'view'])
    ->where('id', '[0-9]+')
    ->name('items.show');
