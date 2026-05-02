@extends('layouts.app')

@section('title', 'Hiscores')

@section('content')
    <h1>Hiscores @if ($skill)&mdash; Skill #{{ $skill }}@else (Overall)@endif</h1>
    <table class="hiscores">
        <thead><tr><th>Rank</th><th>Username</th><th>Level</th><th>XP</th></tr></thead>
        <tbody>
        @foreach ($rows as $row)
            <tr>
                <td>{{ $row->rank ?? '?' }}</td>
                <td><a href="/services/m=adventurers-log/a={{ urlencode($row->username) }}/main.ws">{{ $row->username }}</a></td>
                <td>{{ $row->level ?? $row->total_level ?? '' }}</td>
                <td>{{ number_format((int) ($row->xp ?? $row->total_xp ?? 0)) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
