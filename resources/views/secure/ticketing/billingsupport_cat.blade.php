@extends('layouts.secure')

@section('title', 'Support Ticket')
@section('crumb', 'Support')

@section('content')
    <div id="article">
        <div class="sectionHeader"><div class="left"><div class="right">
            <h1 class="plaque">Support Ticket</h1>
        </div></div></div>
        <div class="section">
            <p>Category: <strong>{{ $cat ?? '' }}</strong></p>
            <p>Submit non-billing tickets via the <a href="/services/m=forum/">forums</a>.</p>
            <p><a href="/support">&laquo; Back to support</a></p>
        </div>
    </div>
@endsection
