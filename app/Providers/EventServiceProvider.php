<?php

namespace App\Providers;

use App\Listeners\XenforoLoginListener;
use App\Listeners\XenforoLogoutListener;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Login::class => [
            XenforoLoginListener::class,
        ],
        Logout::class => [
            XenforoLogoutListener::class,
        ],
    ];
}
