<?php

namespace App\Providers;

use App\Repositories\AdventurersLogRepository;
use App\Repositories\HiscoresRepository;
use App\Repositories\ItemDbRepository;
use App\Repositories\KbaseRepository;
use Illuminate\Database\Events\ConnectionEstablished;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        foreach ([HiscoresRepository::class, ItemDbRepository::class, AdventurersLogRepository::class, KbaseRepository::class] as $repo) {
            $this->app->singleton($repo);
        }
    }

    public function boot(): void
    {
        Event::listen(ConnectionEstablished::class, function (ConnectionEstablished $event): void {
            if ($event->connection->getName() === 'pgsql_game') {
                $event->connection->statement('SET default_transaction_read_only = on');
            }
        });
    }
}
