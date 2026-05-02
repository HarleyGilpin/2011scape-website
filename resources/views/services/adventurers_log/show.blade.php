@extends('layouts.app')

@section('title', ($profile->username ?? 'Adventurer').' - Adventurer\'s Log')

@section('content')
    <h1>{{ $profile->username ?? 'Adventurer' }}</h1>
    <h2>Recent activity</h2>
    @forelse ($activity as $entry)
        <p><strong>{{ $entry->created_at ?? '' }}</strong> &mdash; {{ $entry->description ?? $entry->message ?? '' }}</p>
    @empty
        <p>No activity recorded.</p>
    @endforelse
@endsection
