<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DisplaynameController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\TicketingController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'form'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::match(['get', 'post'], '/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/recover', [PasswordResetController::class, 'requestForm'])->name('recover');
Route::post('/recover', [PasswordResetController::class, 'request'])->name('recover.request');
Route::get('/recover/{token}', [PasswordResetController::class, 'resetForm'])
    ->where('token', '[A-Za-z0-9]+')
    ->name('recover.confirm');
Route::post('/recover/{token}', [PasswordResetController::class, 'reset'])
    ->where('token', '[A-Za-z0-9]+')
    ->name('recover.submit');

Route::middleware('auth')->group(function () {
    Route::get('/members', [AuthController::class, 'members'])->name('members');
    Route::match(['get', 'post'], '/account/displayname', [DisplaynameController::class, 'form'])->name('displaynames');
    Route::get('/support', [TicketingController::class, 'index'])->name('support');
    Route::get('/support/new', [TicketingController::class, 'createForm'])->name('support.new');
    Route::post('/support', [TicketingController::class, 'create'])->name('support.create');
    Route::view('/support/thanks', 'secure.ticketing.thanks')->name('support.thanks');
    Route::get('/support/{cat}', [TicketingController::class, 'show'])
        ->where('cat', '[0-9]+')
        ->name('support.cat');
});
