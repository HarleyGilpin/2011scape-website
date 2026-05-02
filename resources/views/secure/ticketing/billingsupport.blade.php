@extends('layouts.secure')

@section('title', 'Customer Support')
@section('crumb', 'Support')

@section('content')
    <div id="article">
        <div class="sectionHeader"><div class="left"><div class="right">
            <h1 class="plaque">Customer Support</h1>
        </div></div></div>
        <div class="section">
            <div class="article">
                <p>Need help? Submit a ticket below or browse the <a href="/kb">knowledge base</a> for answers.</p>
                <p><a href="/support/new"><strong>Submit a new ticket</strong> &raquo;</a></p>

                @isset($tickets)
                    <h2>Your recent tickets</h2>
                    @forelse ($tickets as $t)
                        <p>
                            <strong>#{{ $t->id }} {{ $t->subject }}</strong>
                            &mdash; {{ \App\Http\Controllers\TicketingController::CATEGORIES[$t->category] ?? $t->category }}
                            &mdash; <em>{{ ucfirst($t->status) }}</em>
                            &mdash; {{ $t->created_at?->diffForHumans() }}
                        </p>
                    @empty
                        <p>You haven't opened any tickets yet.</p>
                    @endforelse
                @endisset
            </div>
        </div>
    </div>
@endsection
