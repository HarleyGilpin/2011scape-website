@extends('layouts.secure')

@section('title', 'Secure Login - RuneScape')
@section('crumb', 'Secure Login')

@section('content')
    <div id="article">
        <div class="sectionHeader">
            <div class="left"><div class="right">
                <h1 class="plaque">Secure Login</h1>
            </div></div>
        </div>
        <div class="section">
            <div class="brown_background">
                <div id="login_background" class="inner_brown_background">
                    <div id="login_panel" class="brown_box">
                        <form id="login_form" action="/secure/m=weblogin/login.html" method="post" autocomplete="off">
                            @csrf
                            <div class="bottom"><div class="repeat">
                                <div class="top_section">
                                    <div id="message">
                                        @if ($errors->any())
                                            <p class="error">{{ $errors->first() }}</p>
                                        @endif
                                    </div>
                                    <div class="section_form" id="usernameSection">
                                        <label for="username">Login:</label>
                                        <input size="20" type="text" name="username" id="username" value="{{ old('username') }}" required>
                                    </div>
                                    <div class="section_form" id="passwordSection">
                                        <label for="password">Password:</label>
                                        <input size="20" type="password" id="password" name="password" maxlength="20" required>
                                    </div>
                                </div>
                                <div class="bottom_section" id="bottomSection">
                                    <div id="remember">
                                        <input type="checkbox" name="rem" id="rem" value="1" class="checkbox" {{ old('rem') ? 'checked' : '' }}>
                                        <label for="rem">Check this box to remember login</label>
                                    </div>
                                    <div id="submit_button">
                                        <button type="submit" value="Login Now!" onmouseover="this.style.backgroundPosition='bottom';" onmouseout="this.style.backgroundPosition='top';" onclick="return SetFocus();">Login Now!</button>
                                    </div>
                                    <input type="hidden" name="mod" value="www">
                                    <input type="hidden" name="ssl" value="1">
                                    <input type="hidden" name="dest" value="{{ $dest }}">
                                </div>
                            </div></div>
                        </form>
                    </div>
                    <div class="buttons">
                        <a href="/services/m=forum/register/" id="loginPlay" class="createaccount"><span class="buttbg"></span>Create a New Account<br>Click Here!</a>
                        <a href="/secure/m=account-recovery/" class="recoveraccount"><span class="butt1bg"></span>Lost Your Password?<br>Click Here!</a>
                    </div>
                    <div id="warning">
                        <div id="warning_image">
                            <p>Only enter your password on pages served from <strong>2011.rs</strong>.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>document.addEventListener('DOMContentLoaded', function () { var u = document.getElementById('username'); if (u && u.value === '') u.focus(); });</script>
@endpush
