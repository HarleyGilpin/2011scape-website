<?php

use App\Http\Controllers\GameLaunchController;
use Illuminate\Support\Facades\Route;

Route::get('game.html', [GameLaunchController::class, 'index'])->name('gamelaunch');
Route::get('game-autocreate-true.html', [GameLaunchController::class, 'index']);
Route::get('classicapplet/playclassic.html', [GameLaunchController::class, 'classic'])->name('gamelaunch.classic');

Route::get('world{n}/{stub}', [GameLaunchController::class, 'redirect'])
    ->where(['n' => '8|14', 'stub' => ',j0,f\d+\.html']);
