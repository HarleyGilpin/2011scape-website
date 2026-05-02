@extends('layouts.app')

@section('title', 'Rules - '.$page)

@section('content')
    <h1>Rules &mdash; {{ str_replace('_', ' ', $page) }}</h1>
    <p>The full set of game rules from 2011 is preserved for reference. Server-specific moderation policy is announced in the <a href="/services/m=forum/">forums</a>.</p>
@endsection
