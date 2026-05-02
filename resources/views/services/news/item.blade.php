@extends('layouts.app')

@section('title', $item->title.' - RuneScape News')

@section('content')
    <article class="news-item full">
        <div id="newsTitle">
            @if ($item->published_at)<b>{{ $item->published_at->format('d-M-Y') }} - </b>@endif
            <h2>{{ $item->title }}</h2>
        </div>
        <div class="newsJustify">
            {!! $item->body_html !!}
        </div>
        @if ($item->author)<p><b><i>{{ $item->author }}</i></b></p>@endif
    </article>
    <p><a href="/news">&laquo; Back to news</a></p>
@endsection
