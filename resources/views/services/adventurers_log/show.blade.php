@extends('layouts.app')

@section('title', ($profile->display_name ?? $profile->name).' - Adventurer\'s Log')
@section('crumb', $profile->display_name ?? $profile->name)

@section('content')
    <div id="article">
        <div class="sectionHeader"><div class="left"><div class="right">
            <h1 class="plaque">{{ $profile->display_name ?? $profile->name }}</h1>
        </div></div></div>

        <div class="section">
            <div class="article">
                @if (! empty($profile->name_history) && is_array($profile->name_history))
                    <p class="name-history"><strong>Previously known as:</strong> {{ implode(', ', $profile->name_history) }}</p>
                @endif

                <h2>Skills</h2>
                @if ($skills->isEmpty())
                    <p>No skill data on record yet.</p>
                @else
                    <table class="skill-grid" cellpadding="6" cellspacing="0" style="border-collapse:collapse">
                        <thead>
                            <tr><th>Skill</th><th>Level</th><th>XP</th></tr>
                        </thead>
                        <tbody>
                            @foreach ($skills as $row)
                                <tr>
                                    <td><img src="/img/main/skins/default/skillicons/{{ $row->skill }}.gif" alt="" onerror="this.style.display='none'"> {{ ucfirst($row->skill) }}</td>
                                    <td style="text-align:right">{{ $row->level }}</td>
                                    <td style="text-align:right">{{ number_format($row->xp) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr style="font-weight:bold;border-top:2px solid #555">
                                <td>Total</td>
                                <td style="text-align:right">{{ number_format($totals->level) }}</td>
                                <td style="text-align:right">{{ number_format($totals->xp) }}</td>
                            </tr>
                        </tfoot>
                    </table>
                @endif

                <h2 style="margin-top:2em">Recent Activity</h2>
                @forelse ($activity as $entry)
                    <p><strong>{{ $entry->created_at }}</strong> &mdash; {{ $entry->description }}</p>
                @empty
                    <p>No activity recorded yet.</p>
                @endforelse
            </div>
        </div>

        <p><a href="/hiscores">&laquo; Back to hiscores</a></p>
    </div>
@endsection
