<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DisplaynameController;
use App\Http\Controllers\TicketingController;
use Illuminate\Support\Facades\Route;

Route::get('secure/m=weblogin/loginform.html', [AuthController::class, 'form'])->name('login');
Route::post('secure/m=weblogin/login.html', [AuthController::class, 'login'])->name('login.submit');
Route::match(['get', 'post'], 'secure/m=weblogin/logout.html', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('secure/m=weblogin/members/members.html', [AuthController::class, 'members'])->name('members');
    Route::match(['get', 'post'], 'secure/m=displaynames/name.html', [DisplaynameController::class, 'form'])->name('displaynames');
    Route::get('secure/m=ticketing/{page}.html', [TicketingController::class, 'show'])
        ->where('page', 'billingsupport(-cat-\d+)?')
        ->name('ticketing');
});
