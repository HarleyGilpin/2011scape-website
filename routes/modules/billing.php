<?php

use App\Http\Controllers\BillingController;
use Illuminate\Support\Facades\Route;

Route::get('secure/m=billing_core/{page}.html', [BillingController::class, 'show'])
    ->where('page', 'paymentoptions|unsubscribe|userdetails')
    ->name('billing.show');
