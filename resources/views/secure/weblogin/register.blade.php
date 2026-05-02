@extends('layouts.secure')

@section('title', 'Create a New Account - 2011scape')
@section('crumb', 'Create Account')

@push('head')
<style>
.register-form { width: 460px; margin: 0 auto; padding: 18px 24px 28px; background: #efe7d2; border: 1px solid #6c4f1d; border-radius: 6px; box-shadow: 0 2px 8px rgba(0,0,0,.35); color: #3a2a0e; font-family: arial, sans-serif; }
.register-form h2 { margin: 0 0 14px; font-size: 16px; color: #4a2f0d; border-bottom: 1px solid #c8b58a; padding-bottom: 6px; }
.register-form .field { margin-bottom: 10px; }
.register-form label { display: block; font-weight: bold; margin-bottom: 3px; font-size: 12px; }
.register-form label .hint { font-weight: normal; color: #6a5a36; font-size: 11px; }
.register-form input[type="text"], .register-form input[type="email"], .register-form input[type="password"] { width: 96%; padding: 6px 8px; font-size: 13px; border: 1px solid #886a3a; background: #fff; }
.register-form .actions { margin-top: 14px; text-align: center; }
.register-form button { background: #5a8b1f; color: #fff; border: 0; padding: 8px 20px; font-size: 13px; font-weight: bold; cursor: pointer; border-radius: 3px; }
.register-form button:hover { background: #6b9d2a; }
.register-form .alt { margin-top: 10px; text-align: center; font-size: 12px; }
.register-form .errors { background: #fde9e9; border: 1px solid #c00; padding: 6px 10px; margin-bottom: 12px; color: #800; font-size: 12px; }
</style>
@endpush

@section('content')
    <div id="article">
        <div class="sectionHeader"><div class="left"><div class="right">
            <h1 class="plaque">Create a New Account</h1>
        </div></div></div>

        <div class="section">
            <form class="register-form" action="/register" method="post" autocomplete="off">
                @csrf
                <h2>New account</h2>

                @if ($errors->any())
                    <div class="errors">{{ $errors->first() }}</div>
                @endif

                <div class="field">
                    <label for="name">Display name <span class="hint">(1&ndash;12 chars; letters, digits, spaces, hyphens, underscores)</span></label>
                    <input type="text" id="name" name="name" maxlength="12" value="{{ old('name') }}" required>
                </div>

                <div class="field">
                    <label for="email">Email <span class="hint">(optional &mdash; required for password recovery)</span></label>
                    <input type="email" id="email" name="email" maxlength="255" value="{{ old('email') }}">
                </div>

                <div class="field">
                    <label for="password">Password <span class="hint">(min 6 chars)</span></label>
                    <input type="password" id="password" name="password" maxlength="128" required>
                </div>

                <div class="field">
                    <label for="password_confirmation">Confirm password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" maxlength="128" required>
                </div>

                <div class="actions">
                    <button type="submit">Create account</button>
                </div>

                <div class="alt">
                    Already have an account? <a href="/login">Log in here</a>.
                </div>
            </form>
        </div>
    </div>
@endsection
