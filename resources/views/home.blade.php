@extends('layouts.app')

@section('content')
    <div id="slider-wrap">
        <div id="slider">
            <a class="caption" href="/title_video_popup.html"><img src="/img/title/slide-1.jpg" alt=""></a>
        </div>
    </div>

    <section id="news-feed">
        <h2>Latest News</h2>
        @forelse ($news as $item)
            <article class="news-item">
                <h3><a href="/services/m=news/{{ $item->slug }}.html">{{ $item->title }}</a></h3>
                @if ($item->published_at)<p class="date">{{ $item->published_at->format('d-M-Y') }}</p>@endif
                @if ($item->summary)<p>{{ $item->summary }}</p>@endif
            </article>
        @empty
            <p>No news yet.</p>
        @endforelse
    </section>

    <aside id="hottopics">
        <h2>Hot Topics</h2>
        <ul>
            @foreach ($hottopics as $topic)
                <li><a href="{{ $topic->url }}">{{ $topic->label }}</a></li>
            @endforeach
        </ul>
    </aside>
@endsection
