@extends('layouts.kbase')

@section('title', $category->name.' - Knowledge Base')

@section('content')
    <div class="navigation"><div class="location"><a href="/kbase/search.html">Knowledge Base</a> &raquo; <span>{{ $category->name }}</span></div></div>
    <div class="sectionHeader"><h1 class="plaque">{{ $category->name }}</h1></div>
    <ul class="kb-articles">
        @foreach ($articles as $article)
            <li><a href="/kbase/guid/{{ $article->slug }}.html">{{ $article->title }}</a></li>
        @endforeach
    </ul>
    {{ $articles->links() }}
@endsection
