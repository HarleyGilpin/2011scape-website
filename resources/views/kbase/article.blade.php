@extends('layouts.kbase')

@section('title', $article->title.' - Knowledge Base')

@section('content')
    <div class="navigation">
        <div class="location">
            <a href="/kb">Knowledge Base</a>
            @if ($article->category)
                &raquo; <a href="/kb/category/{{ $article->category->slug }}">{{ $article->category->name }}</a>
            @endif
            &raquo; <span>{{ $article->title }}</span>
        </div>
    </div>
    <div class="sectionHeader"><h1 class="plaque">{{ $article->title }}</h1></div>
    <div class="article">
        {!! $article->body_html !!}
    </div>
@endsection
