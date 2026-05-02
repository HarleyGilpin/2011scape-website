<?php

namespace App\Http\Controllers;

use App\Repositories\HiscoresRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class HiscoresController extends Controller
{
    public function __construct(private readonly HiscoresRepository $hiscores) {}

    public function ranking(Request $request): View
    {
        $skill = (int) $request->query('skill', 0);
        $rows = $skill > 0
            ? $this->hiscores->topBySkill($skill, 50)
            : $this->hiscores->topByOverall(50);

        return view('services.hiscore.ranking', ['rows' => $rows, 'skill' => $skill]);
    }
}
