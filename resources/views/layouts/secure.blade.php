<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/vnd.microsoft.icon" href="/favicon.ico">
    <link rel="SHORTCUT ICON" href="/favicon.ico">
    <link rel="apple-touch-icon" href="/img/mobile.png">
    <link href="/css/global-38.css" rel="stylesheet">
    <link href="/css/weblogin-9.css" rel="stylesheet">
    <script type="text/javascript" src="/jagex.com/js/jquery/jquery_1_4_2.js"></script>
    <script type="text/javascript">
    function SetFocus() {
        var u = document.getElementById('username');
        var p = document.getElementById('password');
        if (u && u.value === '') { u.focus(); return false; }
        if (p && p.value === '') { p.focus(); return false; }
        return true;
    }
    function ShowWarning() { /* legacy stub */ }
    </script>
    <title>@yield('title', 'RuneScape')</title>
    @stack('head')
</head>
<body id="navaccount" class="bodyBackground">
    @include('layouts._partials.page_open')
        @yield('content')
    @include('layouts._partials.page_close')
    @stack('scripts')
</body>
</html>
