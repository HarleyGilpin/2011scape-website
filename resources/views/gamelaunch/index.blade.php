@extends('layouts.app')

@section('title', 'Play 2011scape')

@section('content')
    <h1>Play 2011scape</h1>
    <p>Download the launcher to begin your adventure.</p>

    <ul class="downloads">
        @if ($platform === 'windows')
            <li><a href="/downloads/runescape-261110.msi" class="primary">Download for Windows (MSI)</a></li>
        @elseif ($platform === 'macos')
            <li><a href="/downloads/jagexlauncher-src-261110.bz2">Download (macOS / source)</a></li>
        @else
            <li><a href="/downloads/jagexlauncher-src-261110.bz2">Download (source)</a></li>
        @endif
    </ul>

    <h2>Other downloads</h2>
    <ul>
        <li><a href="/downloads/runescape-261110.msi">Windows installer (MSI)</a></li>
        <li><a href="/downloads/RuneScape-20090424.exe">Legacy Windows installer (EXE)</a></li>
        <li><a href="/downloads/jagexlauncher-src-261110.bz2">Source (.bz2)</a></li>
        <li><a href="/play/classic">Classic applet</a></li>
    </ul>
@endsection
