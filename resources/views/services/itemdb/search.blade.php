@extends('layouts.app')

@section('title', 'Item Database')

@section('content')
    <h1>Item Database</h1>
    <form method="get" action="/services/m=itemdb_rs/results">
        <input type="search" name="query" value="{{ $q }}" placeholder="Search items">
        <button type="submit">Search</button>
    </form>

    @if ($q !== '')
        <ul class="item-results">
            @forelse ($results as $item)
                <li><a href="/services/m=itemdb_rs/viewitem.ws?obj={{ $item->id }}">{{ $item->name }}</a></li>
            @empty
                <li>No items match.</li>
            @endforelse
        </ul>
    @else
        <h2>Categories</h2>
        <ul>
            @foreach ($categories as $cat)<li>{{ $cat->name }}</li>@endforeach
        </ul>
    @endif
@endsection
