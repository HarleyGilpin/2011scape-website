@extends('layouts.secure')

@section('title', 'Create a New Account - 2011scape')
@section('crumb', 'Create Account')

@section('content')
    <div id="article">
        <div class="sectionHeader"><div class="left"><div class="right">
            <h1 class="plaque">Create a New Account</h1>
        </div></div></div>

        <div class="section">
            <div class="brown_background">
                <div id="login_background" class="inner_brown_background">
                    <div id="login_panel" class="brown_box">
                        <form id="login_form" action="/register" method="post" autocomplete="off">
                            @csrf
                            <div class="bottom"><div class="repeat">
                                <div class="top_section">
                                    <div id="message">
                                        @if ($errors->any())
                                            <p class="error">{{ $errors->first() }}</p>
                                        @endif
                                    </div>

                                    <div class="section_form" id="usernameSection">
                                        <label for="name">Display Name:</label>
                                        <input size="20" type="text" name="name" id="name" maxlength="12" value="{{ old('name') }}" required>
                                    </div>

                                    <div class="section_form">
                                        <label for="email">Email <span style="font-weight:normal">(optional, for password recovery)</span>:</label>
                                        <input size="20" type="email" name="email" id="email" maxlength="255" value="{{ old('email') }}">
                                    </div>

                                    <div class="section_form" id="passwordSection">
                                        <label for="password">Password:</label>
                                        <input size="20" type="password" id="password" name="password" maxlength="128" required>
                                    </div>

                                    <div class="section_form">
                                        <label for="password_confirmation">Confirm Password:</label>
                                        <input size="20" type="password" id="password_confirmation" name="password_confirmation" maxlength="128" required>
                                    </div>
                                </div>
                                <div class="bottom_section">
                                    <div id="submit_button">
                                        <button type="submit">Create Account</button>
                                    </div>
                                </div>
                            </div></div>
                        </form>
                    </div>
                    <div class="buttons">
                        <a href="/login" class="recoveraccount"><span class="butt1bg"></span>Already have an account?<br>Log in</a>
                    </div>
                    <div id="warning"><div id="warning_image">
                        <p>1&ndash;12 characters. Letters, digits, spaces, hyphens, underscores. Names like &ldquo;admin&rdquo; or &ldquo;mod&rdquo; are reserved.</p>
                    </div></div>
                </div>
            </div>
        </div>
    </div>
@endsection
