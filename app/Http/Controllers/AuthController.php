<?php

namespace App\Http\Controllers;

use App\Services\AccountFactory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function __construct(private readonly AccountFactory $accounts) {}

    public function form(Request $request): View
    {
        return view('secure.weblogin.form', [
            'dest' => (string) $request->query('dest', ''),
        ]);
    }

    public function login(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'username' => ['required', 'string', 'max:64'],
            'password' => ['required', 'string'],
        ]);

        $remember = $request->boolean('rem');
        $dest = (string) $request->input('dest', '');

        Session::put('_xf_login_password', $data['password']);

        $credentials = ['name' => $data['username'], 'password' => $data['password']];

        if (! Auth::attempt($credentials, $remember)) {
            Session::forget('_xf_login_password');
            throw ValidationException::withMessages([
                'username' => __('Invalid username or password.'),
            ]);
        }

        $request->session()->regenerate();

        return redirect()->intended($dest !== '' ? $this->safeDest($dest) : '/members');
    }

    public function members(): View
    {
        return view('secure.weblogin.members');
    }

    public function registerForm(): View
    {
        return view('secure.weblogin.register');
    }

    public function register(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'min:1', 'max:12', 'regex:/^[A-Za-z0-9_ \-]+$/'],
            'email' => ['nullable', 'email:rfc', 'max:255'],
            'password' => ['required', 'string', 'min:6', 'max:128', 'confirmed'],
        ]);

        $name = trim($data['name']);

        if ($this->accounts->isReserved($name)) {
            throw ValidationException::withMessages(['name' => __('That name is reserved.')]);
        }

        if ($this->accounts->nameIsTaken($name)) {
            throw ValidationException::withMessages(['name' => __('That name is already taken.')]);
        }

        $accountId = $this->accounts->create($name, $data['password'], $data['email'] ?? null);

        Auth::loginUsingId($accountId);
        $request->session()->regenerate();

        return redirect('/members')->with('status', "Welcome, {$name}!");
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
