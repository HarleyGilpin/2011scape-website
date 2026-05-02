<?php

namespace App\Http\Controllers;

use App\Services\PlayerCountService;
use Illuminate\Contracts\View\View;

class WorldlistController extends Controller
{
    public function __construct(private readonly PlayerCountService $players) {}

    public function index(): View
    {
        $online = $this->players->count();

        $worlds = [
            [
                'id' => 1,
                'name' => '2011scape',
                'country' => 'Global',
                'flag' => '/img/main/layout/en.gif',
                'members' => true,
                'players' => $online,
                'activity' => 'General',
                'ping' => null,
            ],
        ];

        return view('pages.worldlist', ['worlds' => $worlds, 'online' => $online]);
    }
}
