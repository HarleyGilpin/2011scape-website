<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class BillingController extends Controller
{
    public function show(string $page): View
    {
        return view('secure.billing.'.$page, ['page' => $page]);
    }
}
