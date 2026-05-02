@extends('layouts.app')

@section('title', 'Hiscores')

@section('content')
    <h1>Hiscores @if ($skill !== '')&mdash; {{ ucfirst($skill) }}@else (Overall)@endif</h1>

    <nav class="skill-tabs">
        <a href="/hiscores"@if ($skill === '') class="active"@endif>Overall</a>
        @foreach ($skills as $s)
            <a href="/hiscores?skill={{ $s }}"@if ($skill === $s) class="active"@endif>{{ ucfirst($s) }}</a>
        @endforeach
    </nav>

    <table class="hiscores">
        <thead><tr><th>Rank</th><th>Name</th><th>Level</th><th>XP</th></tr></thead>
        <tbody>
        @forelse ($rows as $row)
            <tr>
                <td>{{ $row->rank ?? '?' }}</td>
                <td><a href="/adventurer/{{ urlencode($row->name) }}">{{ $row->name }}</a></td>
                <td>{{ $row->level ?? $row->total_level ?? '' }}</td>
                <td>{{ number_format((int) ($row->xp ?? $row->total_xp ?? 0)) }}</td>
            </tr>
        @empty
            <tr><td colspan="4">No players yet.</td></tr>
        @endforelse
        </tbody>
    </table>
@endsection
