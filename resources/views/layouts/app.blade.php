<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link href="/css/rs2010/global-2.css" rel="stylesheet">
    <link href="/css/rs2010/oldmenu-5.css" rel="stylesheet">
    <link href="/css/rs2010/title-5.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/jagex.com/css/shadowbox/shadowbox-0.css">
    <script type="text/javascript" src="/jagex.com/js/jquery/jquery_1_4_2.js"></script>
    <script type="text/javascript" src="/jagex.com/js/jquery/jquery_placeholder_0_9.js"></script>
    <script type="text/javascript" src="/jagex.com/js/jquery/jquery_arturoSlider_0_9_3.js"></script>
    <script type="text/javascript" src="/jagex.com/js/jquery/jquery_elide_1_1.js"></script>
    <script type="text/javascript" src="/jagex.com/js/shadowbox/shadowbox-0.js"></script>
    <script src="/css/rs2010/globaljs-1.js"></script>
    <title>@yield('title', 'RuneScape - MMORPG - The No.1 Free Online Multiplayer Game')</title>
    <meta name="description" content="@yield('description', 'Play RuneScape for free.')">
    <link rel="icon" type="image/vnd.microsoft.icon" href="/favicon.ico">
    <link rel="SHORTCUT ICON" href="/favicon.ico">
    @stack('head')
</head>
<body>
    <div id="page-wrap">
        <div id="header">
            <a href="/"><img src="/img/banner-runescape.png" alt="RuneScape"></a>
            @auth
                <div class="user-bar">
                    Logged in as <strong>{{ Auth::user()->getAuthIdentifier() }}</strong>
                    &middot; <a href="/secure/m=weblogin/members/members.html">Members</a>
                    &middot; <form method="post" action="/secure/m=weblogin/logout.html" style="display:inline">@csrf<button type="submit" class="link-btn">Logout</button></form>
                </div>
            @else
                <div class="user-bar"><a href="/secure/m=weblogin/loginform.html">Existing user? Login</a></div>
            @endauth
        </div>

        <ul id="oldmenu">
            <li><a href="/">Home</a></li>
            <li><a href="/game.html">Play</a></li>
            <li><a href="/services/m=news/index.html">News</a></li>
            <li><a href="/services/m=devblog/index.html">Dev Blog</a></li>
            <li><a href="/kbase/search.html">Knowledge Base</a></li>
            <li><a href="/services/m=hiscore/ranking.ws">Hiscores</a></li>
            <li><a href="/services/m=forum/">Forums</a></li>
            <li><a href="/services/m=itemdb_rs/">Item DB</a></li>
        </ul>

        <main id="content">
            @yield('content')
        </main>

        <footer id="footer">
            <p>&copy; 2026 2011scape &middot; <a href="/terms/terms.html">Terms</a> &middot; <a href="/privacy/privacy.html">Privacy</a> &middot; <a href="/rules/rules.html">Rules</a></p>
        </footer>
    </div>
    @stack('scripts')
</body>
</html>
