<?php

use App\Http\Controllers\BillingController;
use Illuminate\Support\Facades\Route;

Route::get('/billing/{page}', [BillingController::class, 'show'])
    ->where('page', 'paymentoptions|unsubscribe|userdetails')
    ->name('billing.show');
