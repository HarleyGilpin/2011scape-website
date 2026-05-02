@extends('layouts.app')

@section('title', 'Dev Blog - RuneScape')

@section('content')
    <h1>Dev Blog</h1>
    <p class="lede">Welcome to the developers' blog. Get a behind-the-scenes look at the team building 2011scape.</p>

    @forelse ($posts as $post)
        <article class="devblog-post">
            <h3><a href="/devblog/{{ $post->slug }}">{{ $post->title }}</a></h3>
            @if ($post->published_at)<p class="date">{{ $post->published_at->format('d-M-Y') }}</p>@endif
            @if ($post->hero_image)<img src="{{ $post->hero_image }}" alt="">@endif
        </article>
    @empty
        <p>No dev blog posts yet. Check back soon.</p>
    @endforelse

    @if ($posts->hasPages())
        {{ $posts->links() }}
    @endif
@endsection
