@extends('layouts.app')

@section('title', '2011scape - The No.1 Free Online Multiplayer Game')

@section('content')
    <div id="article">
        <div class="sectionHeader"><div class="left"><div class="right">
            <h1 class="plaque">Welcome to 2011scape</h1>
        </div></div></div>

        <div class="section">
            <div class="article">
                <div id="slider-wrap">
                    <a href="/play"><img src="/img/main/home2010/banners/king-of-the-dwarves.jpg" alt="King of the Dwarves" style="max-width:100%;display:block"></a>
                </div>

                <h2>Latest News</h2>
                <ul class="newsList">
                    @forelse ($news as $item)
                        <li>
                            @if ($item->published_at)<span class="newsPosted">{{ $item->published_at->format('d-M-Y') }}</span>@endif
                            <a class="newsItem" href="/news/{{ $item->slug }}"><strong>{{ $item->title }}</strong></a>
                            @if ($item->summary)<p>{{ $item->summary }}</p>@endif
                        </li>
                    @empty
                        <li>No news yet. <a href="/news">View archive</a></li>
                    @endforelse
                </ul>
                <p><a href="/news">All news &raquo;</a> &middot; <a href="/news.rss">RSS</a></p>
            </div>
        </div>

        <div class="section">
            <div class="article">
                <h2>Hot Topics</h2>
                <ul class="hottopics">
                    @foreach ($hottopics as $topic)
                        <li><a href="{{ $topic->url }}">{{ $topic->label }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
