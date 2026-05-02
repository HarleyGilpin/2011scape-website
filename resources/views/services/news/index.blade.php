@extends('layouts.app')

@section('title', 'News - RuneScape')

@section('content')
    <h1>News</h1>
    @foreach ($items as $item)
        <article class="news-item">
            <h3><a href="/services/m=news/{{ $item->slug }}.html">{{ $item->title }}</a></h3>
            @if ($item->published_at)<p class="date">{{ $item->published_at->format('d-M-Y') }}</p>@endif
            @if ($item->summary)<p>{{ $item->summary }}</p>@endif
        </article>
    @endforeach
    {{ $items->links() }}
@endsection
