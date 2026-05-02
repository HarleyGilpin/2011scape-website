<?php

namespace App\Http\Controllers;

use App\Models\DisplaynameChange;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DisplaynameController extends Controller
{
    public function form(Request $request): View|RedirectResponse
    {
        if ($request->isMethod('post')) {
            $data = $request->validate([
                'new_name' => ['required', 'string', 'min:1', 'max:12', 'regex:/^[A-Za-z0-9_ \-]+$/'],
            ]);

            $user = Auth::user();
            DisplaynameChange::create([
                'user_account_id' => (int) $user->getAuthIdentifier(),
                'old_name' => method_exists($user, 'name') ? $user->name() : (string) ($user->getAttribute('name') ?? ''),
                'new_name' => $data['new_name'],
                'requested_at' => now(),
                'status' => 'pending',
            ]);

            return redirect()->to('/secure/m=displaynames/name.html')->with('status', 'Display name change queued for review.');
        }

        return view('secure.displaynames.name');
    }
}
