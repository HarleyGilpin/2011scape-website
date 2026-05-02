@extends('layouts.secure')

@section('title', 'Ticket received')
@section('crumb', 'Ticket received')

@section('content')
    <div id="article">
        <div class="sectionHeader"><div class="left"><div class="right">
            <h1 class="plaque">Thanks &mdash; ticket received</h1>
        </div></div></div>
        <div class="section">
            <div class="article">
                <p>Your ticket has been opened. A moderator will get back to you via the email on file (or via the forums) within 48 hours.</p>
                <p><a href="/support">Back to Customer Support</a></p>
            </div>
        </div>
    </div>
@endsection
