@if (! empty($poll))
    <a name="poll"></a>
    <div id="poll" class="community Shadow">
        <div class="Shadow"></div>
        <div class="Caster">
            <span class="communityTitle"><h2>Quick Poll</h2></span>

            @if (session('poll_status'))
                <p class="poll-status"><strong>{{ session('poll_status') }}</strong></p>
            @endif

            @php
                $voted = $voted ?? false;
                $total = $poll->totalVotes();
            @endphp

            @if ($voted || $total > 0)
                {{-- Show results --}}
                <h3>{{ $poll->question }}</h3>
                <ul class="poll-results">
                    @foreach ($poll->options as $opt)
                        @php $pct = $total > 0 ? round(($opt->vote_count / $total) * 100) : 0; @endphp
                        <li>
                            <div class="poll-result-row">
                                <span class="poll-label">{{ $opt->label }}</span>
                                <span class="poll-pct">{{ $pct }}% ({{ $opt->vote_count }})</span>
                            </div>
                            <div class="poll-bar" style="background:#ddd;height:6px;border-radius:3px;margin:4px 0">
                                <div style="width:{{ $pct }}%;height:6px;background:#5a8b1f;border-radius:3px"></div>
                            </div>
                        </li>
                    @endforeach
                </ul>
                <p style="font-size:11px;color:#777">{{ number_format($total) }} vote{{ $total === 1 ? '' : 's' }} total.</p>
            @else
                <form action="/polls/{{ $poll->id }}/vote" method="post">
                    @csrf
                    <h3>{{ $poll->question }}</h3>
                    <ul>
                        @foreach ($poll->options as $i => $opt)
                            <li>
                                <input class="pollRadio" type="radio" name="option_id" id="pollVote{{ $i }}" value="{{ $opt->id }}">
                                <label for="pollVote{{ $i }}">{{ $opt->label }}</label>
                            </li>
                        @endforeach
                    </ul>
                    <span class="Button Button27Green"><span><span><span><b>vote</b><input value="" type="submit" title="vote"></span></span></span></span>
                </form>
            @endif
        </div>
    </div>
@endif
