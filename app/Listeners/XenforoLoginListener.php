<?php

namespace App\Listeners;

use App\Services\XenforoBridge;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Session;

class XenforoLoginListener
{
    public function handle(Login $event): void
    {
        $username = $event->user->getAuthIdentifier();
        $password = Session::pull('_xf_login_password');

        if (! is_string($username) || ! is_string($password) || $password === '') {
            return;
        }

        $result = XenforoBridge::fromConfig()->login($username, $password);
        if ($result !== null) {
            Session::put('_xf_session_id', $result['session_id']);
        }
    }
}
