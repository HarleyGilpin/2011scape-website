<?php

namespace App\Services;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class XenforoBridge
{
    public function __construct(
        private readonly string $baseUrl,
        private readonly string $apiKey,
        private readonly int $apiUser,
        private readonly string $cookiePrefix,
    ) {}

    public static function fromConfig(): self
    {
        return new self(
            rtrim((string) config('services.xenforo.url', env('XENFORO_URL', '')), '/'),
            (string) config('services.xenforo.api_key', env('XENFORO_API_KEY', '')),
            (int) config('services.xenforo.api_user', env('XENFORO_API_USER', 1)),
            (string) config('services.xenforo.cookie_prefix', env('XENFORO_COOKIE_PREFIX', 'xf_')),
        );
    }

    public function login(string $username, string $password): ?array
    {
        if ($this->baseUrl === '' || $this->apiKey === '') {
            return null;
        }

        $response = Http::withHeaders([
            'XF-Api-Key' => $this->apiKey,
            'XF-Api-User' => (string) $this->apiUser,
        ])->asForm()->post($this->baseUrl.'/api/auth/', [
            'login' => $username,
            'password' => $password,
        ]);

        if (! $response->successful()) {
            Log::warning('Xenforo SSO login failed', ['status' => $response->status(), 'body' => $response->body()]);

            return null;
        }

        $data = $response->json();

        $userId = (int) ($data['user']['user_id'] ?? 0);
        $sessionId = (string) ($data['session']['session_id'] ?? '');

        if ($userId <= 0 || $sessionId === '') {
            return null;
        }

        $this->issueCookies($userId, $sessionId);

        return ['user_id' => $userId, 'session_id' => $sessionId];
    }

    public function logout(?string $sessionId): void
    {
        $this->clearCookies();

        if ($this->baseUrl === '' || $this->apiKey === '' || $sessionId === null || $sessionId === '') {
            return;
        }

        Http::withHeaders([
            'XF-Api-Key' => $this->apiKey,
            'XF-Api-User' => (string) $this->apiUser,
        ])->delete($this->baseUrl.'/api/sessions/'.$sessionId);
    }

    private function issueCookies(int $userId, string $sessionId): void
    {
        $minutes = 60 * 24 * 365;
        Cookie::queue(Cookie::make($this->cookiePrefix.'user', (string) $userId, $minutes, '/', null, true, false, false, 'lax'));
        Cookie::queue(Cookie::make($this->cookiePrefix.'session', $sessionId, $minutes, '/', null, true, true, false, 'lax'));
    }

    private function clearCookies(): void
    {
        Cookie::queue(Cookie::forget($this->cookiePrefix.'user'));
        Cookie::queue(Cookie::forget($this->cookiePrefix.'session'));
    }
}
