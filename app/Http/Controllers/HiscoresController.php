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
        $skill = (string) $request->query('skill', '');

        if ($skill !== '' && in_array($skill, HiscoresRepository::SKILLS, true)) {
            $rows = $this->hiscores->topBySkill($skill, 50);
        } else {
            $skill = '';
            $rows = $this->hiscores->topByOverall(50);
        }

        return view('services.hiscore.ranking', [
            'rows' => $rows,
            'skill' => $skill,
            'skills' => HiscoresRepository::SKILLS,
        ]);
    }
}
