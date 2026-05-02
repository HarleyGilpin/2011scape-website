@extends('layouts.secure')

@section('title', 'Account Recovery - 2011scape')
@section('crumb', 'Account Recovery')

@section('content')
    <div id="article">
        <div class="sectionHeader"><div class="left"><div class="right">
            <h1 class="plaque">Account Recovery</h1>
        </div></div></div>

        <div class="section">
            <div class="brown_background">
                <div id="login_background" class="inner_brown_background">
                    <div id="login_panel" class="brown_box">
                        @if (session('status'))
                            <p class="notice"><strong>{{ session('status') }}</strong></p>
                        @endif

                        <form action="/recover" method="post">
                            @csrf
                            <div class="bottom"><div class="repeat">
                                <div class="top_section">
                                    <div id="message">
                                        @if ($errors->any())<p class="error">{{ $errors->first() }}</p>@endif
                                    </div>
                                    <div class="section_form">
                                        <label for="identifier">Username or email:</label>
                                        <input size="24" type="text" name="identifier" id="identifier" required value="{{ old('identifier') }}">
                                    </div>
                                </div>
                                <div class="bottom_section">
                                    <div id="submit_button">
                                        <button type="submit">Send recovery link</button>
                                    </div>
                                </div>
                            </div></div>
                        </form>
                    </div>
                    <div class="buttons">
                        <a href="/login" class="recoveraccount"><span class="butt1bg"></span>Remember it now?<br>Log in</a>
                    </div>
                    <div id="warning"><div id="warning_image">
                        <p>If an account matches the name or email you give us, we'll send (or log) a one-hour reset link.</p>
                    </div></div>
                </div>
            </div>
        </div>
    </div>
@endsection
