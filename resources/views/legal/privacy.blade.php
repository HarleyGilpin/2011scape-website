@extends('layouts.app')

@section('title', 'Privacy - '.$page)

@section('content')
    <h1>Privacy &mdash; {{ str_replace('_', ' ', $page) }}</h1>
    <p>2011scape collects only the data needed to operate the game and the website. See the <a href="/services/m=forum/">forums</a> for the current policy.</p>
@endsection
