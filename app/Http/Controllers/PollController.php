<?php

namespace App\Http\Controllers;

use App\Models\Poll;
use App\Models\PollOption;
use App\Models\PollVote;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class PollController extends Controller
{
    public function vote(Request $request, Poll $poll): RedirectResponse
    {
        if (! $poll->active || ($poll->closes_at && $poll->closes_at->isPast())) {
            return back()->with('poll_status', 'This poll is closed.');
        }

        $data = $request->validate([
            'option_id' => ['required', 'integer'],
        ]);

        $option = PollOption::query()
            ->where('id', $data['option_id'])
            ->where('poll_id', $poll->id)
            ->first();

        if ($option === null) {
            return back()->with('poll_status', 'Invalid option.');
        }

        $token = $this->voterToken($request);

        $existing = PollVote::query()
            ->where('poll_id', $poll->id)
            ->where('voter_token', $token)
            ->exists();

        if ($existing) {
            return back()->with('poll_status', 'You have already voted in this poll.');
        }

        DB::transaction(function () use ($poll, $option, $token) {
            PollVote::create([
                'poll_id' => $poll->id,
                'poll_option_id' => $option->id,
                'user_account_id' => Auth::id(),
                'voter_token' => $token,
            ]);
            $option->increment('vote_count');
        });

        Cookie::queue('voter_token', $token, 60 * 24 * 365 * 2);

        return back()->with('poll_status', 'Vote recorded — thanks!');
    }

    private function voterToken(Request $request): string
    {
        if (Auth::check()) {
            return 'user:'.Auth::id();
        }

        $existing = (string) $request->cookie('voter_token', '');
        if ($existing !== '') {
            return $existing;
        }

        return 'guest:'.Str::random(40);
    }
}
