@extends('layouts.secure')

@section('title', 'Members Area')

@section('content')
    <h1>Members Area</h1>
    <p>Welcome, <strong>{{ Auth::user()->displayName() }}</strong>.</p>
    <p>All membership benefits on this server are <strong>free</strong>. There is nothing to purchase.</p>
    <ul>
        <li><a href="/secure/m=displaynames/name.html">Change display name</a></li>
        <li><a href="/secure/m=ticketing/billingsupport.html">Submit a support ticket</a></li>
        <li><form method="post" action="/secure/m=weblogin/logout.html" style="display:inline">@csrf<button type="submit" class="link-btn">Logout</button></form></li>
    </ul>
@endsection
