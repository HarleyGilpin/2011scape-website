@extends('layouts.secure')

@section('title', 'Login - RuneScape')

@section('content')
    <div id="login-form">
        <h1>Existing User?</h1>
        @if ($errors->any())
            <div class="error">
                @foreach ($errors->all() as $err)<p>{{ $err }}</p>@endforeach
            </div>
        @endif
        <form action="/secure/m=weblogin/login.html" method="post" autocomplete="off">
            @csrf
            <input type="hidden" name="mod" value="www">
            <input type="hidden" name="ssl" value="1">
            <input type="hidden" name="dest" value="{{ $dest }}">

            <label for="username">Username</label>
            <input type="text" id="username" name="username" maxlength="64" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" maxlength="128" required>

            <label class="rem">
                <input type="checkbox" name="rem" value="1"> Remember me
            </label>

            <button type="submit">Login</button>
        </form>
        <p><a href="/services/m=forum/register/">Create a free account</a></p>
    </div>
@endsection
