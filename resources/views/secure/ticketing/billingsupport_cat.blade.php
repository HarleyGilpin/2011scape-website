@extends('layouts.secure')

@section('title', 'Support Ticket')

@section('content')
    <h1>Submit Support Ticket</h1>
    <p>Category: <strong>{{ $page }}</strong></p>
    <p>Submit non-billing tickets via the <a href="/services/m=forum/">forums</a>.</p>
@endsection
