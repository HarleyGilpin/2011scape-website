@extends('layouts.secure')

@section('title', 'Members Area - RuneScape')
@section('crumb', 'Members Area')

@section('content')
    <div id="members">
        <div class="sectionHeader">
            <div class="left"><div class="right">
                <h1 class="plaque">Members Area</h1>
            </div></div>
        </div>
        <div class="section">
            <div id="background">
                <p>Welcome, <strong>{{ Auth::user()->displayName() }}</strong>.</p>
                <p>All membership benefits on this server are <strong>free</strong>. There is nothing to purchase.</p>
                <ul>
                    <li><a href="/secure/m=displaynames/name.html">Change display name</a></li>
                    <li><a href="/secure/m=ticketing/billingsupport.html">Submit a support ticket</a></li>
                    <li>
                        <form method="post" action="/secure/m=weblogin/logout.html" style="display:inline">
                            @csrf
                            <button type="submit" class="link-btn">Log out</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection
