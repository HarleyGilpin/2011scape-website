<?php

namespace App\Providers;

use App\Auth\GameUserProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Auth::provider('game', function ($app, array $config) {
            return new GameUserProvider($app['hash'], $config['model']);
        });
    }
}
