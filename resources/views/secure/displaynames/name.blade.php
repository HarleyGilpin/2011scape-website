@extends('layouts.secure')

@section('title', 'Change Display Name')

@section('content')
    <h1>Change Display Name</h1>

    @if (session('status'))<div class="success"><p>{{ session('status') }}</p></div>@endif
    @if ($errors->any())
        <div class="error">@foreach ($errors->all() as $err)<p>{{ $err }}</p>@endforeach</div>
    @endif

    <form method="post" action="/secure/m=displaynames/name.html">
        @csrf
        <label for="new_name">New display name</label>
        <input type="text" id="new_name" name="new_name" maxlength="12" required>
        <p class="hint">1&ndash;12 characters. Letters, numbers, spaces, hyphens, underscores.</p>
        <button type="submit">Submit for review</button>
    </form>
@endsection
