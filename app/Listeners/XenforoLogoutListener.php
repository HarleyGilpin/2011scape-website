<?php

namespace App\Listeners;

use App\Services\XenforoBridge;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Session;

class XenforoLogoutListener
{
    public function handle(Logout $event): void
    {
        $sessionId = Session::pull('_xf_session_id');
        XenforoBridge::fromConfig()->logout(is_string($sessionId) ? $sessionId : null);
    }
}
