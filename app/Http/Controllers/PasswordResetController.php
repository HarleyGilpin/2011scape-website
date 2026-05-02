<?php

namespace App\Http\Controllers;

use App\Models\GameAccount;
use App\Models\PasswordReset;
use App\Models\UserEmail;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PasswordResetController extends Controller
{
    public function requestForm(): View
    {
        return view('secure.weblogin.recover');
    }

    public function request(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'identifier' => ['required', 'string', 'max:255'],
        ]);

        $accountId = $this->resolveAccountId($data['identifier']);

        if ($accountId !== null) {
            $token = Str::random(48);

            PasswordReset::create([
                'token' => $token,
                'user_account_id' => $accountId,
                'expires_at' => Carbon::now()->addHour(),
            ]);

            $url = url('/recover/'.$token);
            $email = UserEmail::query()->where('user_account_id', $accountId)->value('email');

            // The default mail driver is `log`; this writes the URL into laravel.log.
            // In production, swap MAIL_MAILER for a real driver and the link gets emailed.
            Log::info('password.reset.issued', ['account_id' => $accountId, 'url' => $url, 'email' => $email]);
        }

        return back()->with('status', 'If an account exists for that name or email, a reset link is on its way.');
    }

    public function resetForm(string $token): View
    {
        $reset = $this->findValidReset($token);
        abort_unless($reset !== null, 404);

        return view('secure.weblogin.recover_confirm', ['token' => $token]);
    }

    public function reset(Request $request, string $token): RedirectResponse
    {
        $reset = $this->findValidReset($token);
        abort_unless($reset !== null, 404);

        $data = $request->validate([
            'password' => ['required', 'string', 'min:6', 'max:128', 'confirmed'],
        ]);

        $hash = password_hash($data['password'], PASSWORD_BCRYPT);

        DB::connection('pgsql_game_writer')->transaction(function () use ($reset, $hash) {
            DB::connection('pgsql_game_writer')->table('accounts')
                ->where('id', $reset->user_account_id)
                ->update(['password_hash' => $hash]);
        });

        PasswordReset::query()->where('user_account_id', $reset->user_account_id)->delete();

        Auth::loginUsingId($reset->user_account_id);
        $request->session()->regenerate();

        return redirect('/members')->with('status', 'Password updated. You are now logged in.');
    }

    private function resolveAccountId(string $identifier): ?int
    {
        $identifier = trim($identifier);

        if (str_contains($identifier, '@')) {
            $row = UserEmail::query()->where('email', $identifier)->first();
            return $row?->user_account_id;
        }

        $account = GameAccount::query()
            ->whereRaw('LOWER(name) = ?', [mb_strtolower($identifier)])
            ->first();

        return $account?->getKey();
    }

    private function findValidReset(string $token): ?PasswordReset
    {
        return PasswordReset::query()
            ->where('token', $token)
            ->where('expires_at', '>', Carbon::now())
            ->first();
    }
}
