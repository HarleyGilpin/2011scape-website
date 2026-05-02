<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class XenforoCheck extends Command
{
    protected $signature = 'xf:check {--login= : optional username to test SSO login}
                                     {--password= : optional password for the SSO login test}';

    protected $description = 'Probe the Xenforo REST API to verify XENFORO_URL/API_KEY/cookie prefix.';

    public function handle(): int
    {
        $base = rtrim((string) config('services.xenforo.url'), '/');
        $key = (string) config('services.xenforo.api_key');
        $user = (string) config('services.xenforo.api_user', '1');

        if ($base === '' || $key === '') {
            $this->error('XENFORO_URL or XENFORO_API_KEY not set in .env');
            return self::FAILURE;
        }

        $client = Http::withHeaders([
            'XF-Api-Key' => $key,
            'XF-Api-User' => $user,
        ])->acceptJson();

        $this->probe($client, $base, '/api/me');
        $this->probe($client, $base, '/api/index');

        $login = (string) $this->option('login');
        $password = (string) $this->option('password');
        if ($login !== '' && $password !== '') {
            $this->newLine();
            $this->line('<comment>Testing /api/auth (SSO login):</comment>');
            $resp = $client->asForm()->post($base.'/api/auth/', ['login' => $login, 'password' => $password]);
            $this->line(sprintf('  HTTP %d', $resp->status()));

            $data = $resp->json();
            if (is_array($data)) {
                $userId = $data['user']['user_id'] ?? null;
                $sessionId = $data['session']['session_id'] ?? null;
                $this->line(sprintf('  user_id=%s', $userId ?? '(none)'));
                $this->line(sprintf('  session_id=%s', $sessionId ? substr((string) $sessionId, 0, 8).'…' : '(none)'));
            }
        }

        return self::SUCCESS;
    }

    private function probe($client, string $base, string $path): void
    {
        $resp = $client->get($base.$path);
        $this->line(sprintf('GET %s -> HTTP %d (%d bytes)', $path, $resp->status(), strlen($resp->body())));

        if (! $resp->successful()) {
            $err = $resp->json('errors.0.message') ?? substr($resp->body(), 0, 120);
            $this->warn('  '.$err);
            return;
        }

        $body = $resp->json();
        if (is_array($body)) {
            $top = array_slice(array_keys($body), 0, 6);
            $this->line('  keys: '.implode(', ', $top));
        }
    }
}
