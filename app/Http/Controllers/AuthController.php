<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function form(Request $request): View
    {
        return view('secure.weblogin.form', [
            'dest' => (string) $request->query('dest', ''),
        ]);
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'username' => ['required', 'string', 'max:64'],
            'password' => ['required', 'string'],
        ]);

        $remember = $request->boolean('rem');
        $dest = (string) $request->input('dest', '');

        Session::put('_xf_login_password', $credentials['password']);

        if (! Auth::attempt($credentials, $remember)) {
            Session::forget('_xf_login_password');
            throw ValidationException::withMessages([
                'username' => __('Invalid username or password.'),
            ]);
        }

        $request->session()->regenerate();

        return redirect()->intended($dest !== '' ? $this->safeDest($dest) : '/secure/m=weblogin/members/members.html');
    }

    public function members(): View
    {
        return view('secure.weblogin.members');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    private function safeDest(string $dest): string
    {
        if (str_starts_with($dest, '/') && ! str_starts_with($dest, '//')) {
            return $dest;
        }

        return '/';
    }
}
