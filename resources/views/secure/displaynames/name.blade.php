@extends('layouts.secure')

@section('title', 'Change Display Name')
@section('crumb', 'Change Display Name')

@section('content')
    <div id="article">
        <div class="sectionHeader"><div class="left"><div class="right">
            <h1 class="plaque">Change Display Name</h1>
        </div></div></div>
        <div class="section">
            @if (session('status'))<div class="notice"><p>{{ session('status') }}</p></div>@endif
            @if ($errors->any())
                <div class="notice"><p>{{ $errors->first() }}</p></div>
            @endif

            <p>Current name: <strong>{{ Auth::user()->displayName() }}</strong>.</p>

            @if (! empty($pending))
                <p><em>Pending change to <strong>{{ $pending->new_name }}</strong> queued at {{ $pending->requested_at?->diffForHumans() }}.</em></p>
            @endif

            <form method="post" action="/secure/m=displaynames/name.html">
                @csrf
                <label for="new_name">New display name</label><br>
                <input type="text" id="new_name" name="new_name" maxlength="12" required>
                <p class="hint">1&ndash;12 characters. Letters, numbers, spaces, hyphens, underscores.</p>
                <button type="submit">Apply</button>
            </form>
        </div>
    </div>
@endsection
