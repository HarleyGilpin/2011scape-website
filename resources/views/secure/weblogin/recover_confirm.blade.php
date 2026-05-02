@extends('layouts.secure')

@section('title', 'Set a new password - 2011scape')
@section('crumb', 'Set new password')

@section('content')
    <div id="article">
        <div class="sectionHeader"><div class="left"><div class="right">
            <h1 class="plaque">Set a new password</h1>
        </div></div></div>

        <div class="section">
            <div class="brown_background">
                <div id="login_background" class="inner_brown_background">
                    <div id="login_panel" class="brown_box">
                        <form action="/recover/{{ $token }}" method="post">
                            @csrf
                            <div class="bottom"><div class="repeat">
                                <div class="top_section">
                                    <div id="message">
                                        @if ($errors->any())<p class="error">{{ $errors->first() }}</p>@endif
                                    </div>
                                    <div class="section_form">
                                        <label for="password">New password:</label>
                                        <input size="20" type="password" name="password" id="password" maxlength="128" required>
                                    </div>
                                    <div class="section_form">
                                        <label for="password_confirmation">Confirm:</label>
                                        <input size="20" type="password" name="password_confirmation" id="password_confirmation" maxlength="128" required>
                                    </div>
                                </div>
                                <div class="bottom_section">
                                    <div id="submit_button">
                                        <button type="submit">Update password</button>
                                    </div>
                                </div>
                            </div></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
