<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/vnd.microsoft.icon" href="/favicon.ico">
    <link rel="SHORTCUT ICON" href="/favicon.ico">
    <link rel="apple-touch-icon" href="/img/mobile.png">
    <link href="/css/global-38.css" rel="stylesheet">
    <link href="/css/news-3.css" rel="stylesheet">
    <script type="text/javascript" src="/jagex.com/js/jquery/jquery_1_4_2.js"></script>
    <title>@yield('title', '2011scape - RuneScape Archive')</title>
    @stack('head')
</head>
<body id="navhome" class="bodyBackground">
    @include('layouts._partials.page_open')
        @yield('content')
    @include('layouts._partials.page_close')
    @stack('scripts')
</body>
</html>
