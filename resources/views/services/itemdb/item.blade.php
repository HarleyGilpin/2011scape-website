@extends('layouts.app')

@section('title', ($item->name ?? 'Item').' - Item Database')

@section('content')
    <h1>{{ $item->name ?? 'Item' }}</h1>
    @if (! empty($item->description))<p>{{ $item->description }}</p>@endif
    <ul class="item-meta">
        <li>Members: {{ ! empty($item->members) ? 'yes' : 'no' }}</li>
        <li>Tradeable: {{ ! empty($item->tradeable) ? 'yes' : 'no' }}</li>
    </ul>
    <p><a href="/services/m=itemdb_rs/results">&laquo; Back to search</a></p>
@endsection
