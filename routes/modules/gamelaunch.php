<?php

use App\Http\Controllers\GameLaunchController;
use Illuminate\Support\Facades\Route;

Route::get('/play', [GameLaunchController::class, 'index'])->name('play');
Route::get('/play/classic', [GameLaunchController::class, 'classic'])->name('play.classic');
