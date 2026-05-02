@extends('layouts.app')

@section('title', $post->title.' - Dev Blog')

@section('content')
    <article class="devblog-post full">
        <h1>{{ $post->title }}</h1>
        @if ($post->published_at)<p class="date">{{ $post->published_at->format('d-M-Y') }}</p>@endif
        <div class="body">{!! $post->body_html !!}</div>
        @if ($post->author)<p class="author">&mdash; {{ $post->author }}</p>@endif
    </article>
    <p><a href="/devblog">&laquo; Back to dev blog</a></p>
@endsection
