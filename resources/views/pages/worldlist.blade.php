@extends('layouts.app')

@section('title', 'Server List - 2011scape')
@section('crumb', 'Server List')

@section('content')
    <div id="article">
        <div class="sectionHeader"><div class="left"><div class="right">
            <h1 class="plaque">Server List</h1>
        </div></div></div>

        <div class="section">
            <div class="article">
                <p>Pick a world to play on. <strong>{{ number_format($online) }}</strong> player{{ $online === 1 ? '' : 's' }} currently online.</p>

                <table class="worldlist" cellpadding="6" cellspacing="0" style="border-collapse:collapse;width:100%">
                    <thead>
                        <tr style="background:#2c1f0c;color:#f1c761">
                            <th>World</th>
                            <th>Name</th>
                            <th>Country</th>
                            <th>Type</th>
                            <th>Activity</th>
                            <th>Players</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($worlds as $w)
                            <tr>
                                <td><a href="/play">World {{ $w['id'] }}</a></td>
                                <td>{{ $w['name'] }}</td>
                                <td><img src="{{ $w['flag'] }}" alt="{{ $w['country'] }}"> {{ $w['country'] }}</td>
                                <td>{{ $w['members'] ? 'Members (free)' : 'Free' }}</td>
                                <td>{{ $w['activity'] }}</td>
                                <td style="text-align:right">{{ number_format($w['players']) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <p style="margin-top:1em"><a href="/play">&laquo; Back to Play</a></p>
            </div>
        </div>
    </div>
@endsection
