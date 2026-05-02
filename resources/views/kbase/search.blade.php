@extends('layouts.kbase')

@section('title', 'Search - Knowledge Base')

@section('content')
    <div class="sectionHeader"><h1 class="plaque">Knowledge Base Search</h1></div>
    <form action="/kbase/search.html" method="get" class="kb-search-form">
        <input type="search" name="q" value="{{ $q }}" placeholder="Search articles">
        <button type="submit">Search</button>
    </form>

    @if ($q !== '')
        <p class="result-count">{{ $results->total() }} result{{ $results->total() === 1 ? '' : 's' }} for &ldquo;{{ $q }}&rdquo;</p>
        <ul class="kb-results">
            @forelse ($results as $hit)
                <li>
                    <a href="/kbase/guid/{{ $hit->slug }}.html"><strong>{{ $hit->title }}</strong></a>
                    @if (! empty($hit->snippet))
                        <p class="snippet">{!! preg_replace('#&lt;(/?mark)&gt;#', '<$1>', e($hit->snippet)) !!}</p>
                    @elseif ($hit->search_text)
                        <p>{{ \Illuminate\Support\Str::limit($hit->search_text, 200) }}</p>
                    @endif
                </li>
            @empty
                <li>No results.</li>
            @endforelse
        </ul>
        {{ $results->links() }}
    @endif
@endsection
