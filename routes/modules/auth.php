<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DisplaynameController;
use App\Http\Controllers\TicketingController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'form'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::match(['get', 'post'], '/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/members', [AuthController::class, 'members'])->name('members');
    Route::match(['get', 'post'], '/account/displayname', [DisplaynameController::class, 'form'])->name('displaynames');
    Route::get('/support', [TicketingController::class, 'index'])->name('support');
    Route::get('/support/{cat}', [TicketingController::class, 'show'])
        ->where('cat', '[0-9]+')
        ->name('support.cat');
});
