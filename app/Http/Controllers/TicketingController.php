<?php

namespace App\Http\Controllers;

use App\Models\SupportTicket;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketingController extends Controller
{
    public const CATEGORIES = [
        'account_recovery' => 'Account recovery',
        'billing' => 'Billing',
        'gameplay' => 'Gameplay',
        'abuse_report' => 'Abuse report',
        'bug' => 'Bug report',
        'other' => 'Other',
    ];

    public function index(): View
    {
        $tickets = SupportTicket::query()
            ->where('user_account_id', Auth::id())
            ->orderByDesc('id')
            ->limit(20)
            ->get();

        return view('secure.ticketing.billingsupport', ['tickets' => $tickets]);
    }

    public function show(int $cat): View
    {
        return view('secure.ticketing.billingsupport_cat', ['cat' => $cat]);
    }

    public function createForm(): View
    {
        return view('secure.ticketing.create', ['categories' => self::CATEGORIES]);
    }

    public function create(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'category' => ['required', 'string', 'in:'.implode(',', array_keys(self::CATEGORIES))],
            'subject' => ['required', 'string', 'min:1', 'max:120'],
            'body' => ['required', 'string', 'min:1', 'max:5000'],
        ]);

        SupportTicket::create([
            'user_account_id' => Auth::id(),
            'category' => $data['category'],
            'subject' => $data['subject'],
            'body' => $data['body'],
            'status' => 'open',
        ]);

        return redirect('/support/thanks');
    }
}
