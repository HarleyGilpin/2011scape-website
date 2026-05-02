@extends('layouts.app')

@section('title', 'Terms - '.$page)

@section('content')
    <h1>Terms &mdash; {{ str_replace('_', ' ', $page) }}</h1>
    <p>This is an informational mirror. The full text of the original 2011 Terms is preserved for reference; modifications by 2011scape (a non-commercial server) are noted where applicable.</p>
    <p>For questions, contact us via the <a href="/services/m=forum/">forums</a>.</p>
@endsection
