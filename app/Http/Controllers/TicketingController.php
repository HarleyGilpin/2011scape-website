<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class TicketingController extends Controller
{
    public function show(string $page): View
    {
        $view = match (true) {
            str_starts_with($page, 'billingsupport-cat-') => 'secure.ticketing.billingsupport_cat',
            $page === 'billingsupport' => 'secure.ticketing.billingsupport',
            default => 'secure.ticketing.billingsupport',
        };

        return view($view, ['page' => $page]);
    }
}
