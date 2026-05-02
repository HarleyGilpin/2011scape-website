<?php

namespace App\Http\Controllers;

use App\Repositories\AdventurersLogRepository;
use Illuminate\Contracts\View\View;

class AdventurersLogController extends Controller
{
    public function __construct(private readonly AdventurersLogRepository $log) {}

    public function show(string $user): View
    {
        $username = str_replace('+', ' ', $user);
        $profile = $this->log->profile($username);
        abort_unless($profile !== null, 404);

        $skills = $this->log->skills((int) $profile->id);

        return view('services.adventurers_log.show', [
            'profile' => $profile,
            'skills' => $skills,
            'totals' => $this->log->totals($skills),
            'activity' => $this->log->recentActivity($username),
        ]);
    }
}
