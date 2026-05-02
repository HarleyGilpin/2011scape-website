@extends('layouts.app')

@section('title', 'Rules of Conduct - 2011scape')
@section('crumb', 'Rules')

@section('content')
    <div id="article">
        <div class="sectionHeader"><div class="left"><div class="right">
            <h1 class="plaque">Rules of Conduct</h1>
        </div></div></div>
        <div class="section">
            <div class="article">
                <p>Read each rule carefully. Breaking any of these may result in a temporary or permanent ban.</p>
                <ul>
                    @foreach ($rules as $rule)
                        <li><a href="/rules/{{ $rule['slug'] }}">{{ $rule['title'] }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
