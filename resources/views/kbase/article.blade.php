@extends('layouts.kbase')

@section('title', $article->title.' - Knowledge Base')

@section('content')
    <div class="navigation">
        <div class="location">
            <a href="/kbase/search.html">Knowledge Base</a>
            @if ($article->category)
                &raquo; <a href="/kbase/view-guid-{{ $article->category->slug }}.html">{{ $article->category->name }}</a>
            @endif
            &raquo; <span>{{ $article->title }}</span>
        </div>
    </div>
    <div class="sectionHeader"><h1 class="plaque">{{ $article->title }}</h1></div>
    <div class="article">
        {!! $article->body_html !!}
    </div>
@endsection
