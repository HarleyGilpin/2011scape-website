<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class TicketingController extends Controller
{
    public function index(): View
    {
        return view('secure.ticketing.billingsupport');
    }

    public function show(int $cat): View
    {
        return view('secure.ticketing.billingsupport_cat', ['cat' => $cat]);
    }
}
