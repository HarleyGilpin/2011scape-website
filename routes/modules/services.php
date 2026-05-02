<?php

use App\Http\Controllers\AdventurersLogController;
use App\Http\Controllers\HiscoresController;
use App\Http\Controllers\ItemDbController;
use Illuminate\Support\Facades\Route;

Route::get('services/m=adventurers-log/a={user}/main.ws', [AdventurersLogController::class, 'show'])
    ->where('user', '[A-Za-z0-9_+\-]+')
    ->name('adventurers_log');

Route::get('services/m=hiscore/ranking.ws', [HiscoresController::class, 'ranking'])->name('hiscore.ranking');
Route::view('services/m=hiscore/index.html', 'services.hiscore.index')->name('hiscore.index');

Route::get('services/m=itemdb_rs/{any}', [ItemDbController::class, 'route'])
    ->where('any', '.*')
    ->name('itemdb');
