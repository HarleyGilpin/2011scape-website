<?php

namespace App\Http\Controllers;

use App\Models\DisplaynameChange;
use App\Services\DisplaynameApplier;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class DisplaynameController extends Controller
{
    public function __construct(private readonly DisplaynameApplier $applier) {}

    public function form(Request $request): View|RedirectResponse
    {
        if ($request->isMethod('post')) {
            return $this->submit($request);
        }

        return view('secure.displaynames.name', [
            'pending' => DisplaynameChange::query()
                ->where('user_account_id', Auth::id())
                ->where('status', 'pending')
                ->latest('id')
                ->first(),
        ]);
    }

    private function submit(Request $request): RedirectResponse
    {
        $user = Auth::user();
        abort_if($user === null, 403);

        $accountId = (int) $user->getAuthIdentifier();
        $oldName = method_exists($user, 'name') ? $user->name() : (string) $user->getAttribute('name');

        $data = $request->validate([
            'new_name' => [
                'required',
                'string',
                'min:1',
                'max:12',
                'regex:/^[A-Za-z0-9_ \-]+$/',
                Rule::notIn([$oldName]),
            ],
        ]);

        $newName = $data['new_name'];

        if ($this->applier->isTaken($newName, $accountId)) {
            return back()->withErrors(['new_name' => __('That name is already taken.')]);
        }

        $change = DB::transaction(function () use ($accountId, $oldName, $newName) {
            return DisplaynameChange::create([
                'user_account_id' => $accountId,
                'old_name' => $oldName,
                'new_name' => $newName,
                'requested_at' => now(),
                'status' => 'pending',
            ]);
        });

        try {
            $this->applier->apply($change);
            $message = "Display name updated to {$newName}.";
        } catch (\Throwable $e) {
            report($e);
            $message = 'Submitted for review (game DB temporarily unavailable).';
        }

        return redirect()->to('/secure/m=displaynames/name.html')->with('status', $message);
    }
}
