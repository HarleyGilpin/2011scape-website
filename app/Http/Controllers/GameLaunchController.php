<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class GameLaunchController extends Controller
{
    public function index(Request $request): View
    {
        return view('gamelaunch.index', ['platform' => $this->detectPlatform($request)]);
    }

    public function classic(): View
    {
        return view('gamelaunch.classic');
    }

    public function redirect(Request $request): View
    {
        return view('gamelaunch.index', ['platform' => $this->detectPlatform($request)]);
    }

    private function detectPlatform(Request $request): string
    {
        $ua = (string) $request->userAgent();
        return match (true) {
            str_contains($ua, 'Windows') => 'windows',
            str_contains($ua, 'Mac OS') || str_contains($ua, 'Macintosh') => 'macos',
            str_contains($ua, 'Linux') => 'linux',
            default => 'other',
        };
    }
}
