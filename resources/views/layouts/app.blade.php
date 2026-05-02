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
<body id="navaccount" class="bodyBackground">
    <a name="top"></a>
    <div class="bodyBackgroundHead">
        <div id="menubox">
            <ul id="menus">
                <li class="top"><a href="/" id="home" class="tl"><span class="ts">Home</span></a></li>
                <li class="top"><a id="play" class="tl" href="/game.html"><span class="ts">Play Now</span></a>
                    <ul>
                        <li><a href="/game-autocreate-true.html" class="fly"><span>New Users</span></a></li>
                        <li><a href="/game.html" class="fly"><span>Existing Users</span></a></li>
                        <li><a href="/options.html" class="fly"><span>Java Options</span></a></li>
                    </ul>
                </li>
                <li class="top"><a id="account" class="tl" href="/account_management.html"><span class="ts">Account</span></a>
                    <ul>
                        <li><a href="/secure/m=weblogin/members/members.html" class="fly"><span>Members Area</span></a></li>
                        <li><a href="/services/m=forum/register/" class="fly"><span>Create New Account</span></a></li>
                        <li><a href="/account_management.html" class="fly"><span>Account Management</span></a></li>
                    </ul>
                </li>
                <li class="top"><a id="guide" class="tl" href="/kbase/guid/manual.html"><span class="ts">Game Guide</span></a>
                    <ul>
                        <li><a href="/kbase/search.html" class="fly"><span>Manual</span></a></li>
                        <li><a href="/services/m=itemdb_rs/frontpage.html" class="fly"><span>Grand Exchange</span></a></li>
                        <li><a href="/kbase/guid/rules_of_conduct.html" class="fly"><span>Rules</span></a></li>
                        <li><a href="/splash.html" class="fly"><span>What is RuneScape?</span></a></li>
                    </ul>
                </li>
                <li class="top"><a id="community" class="tl" href="/services/m=forum/"><span class="ts">Community</span></a>
                    <ul>
                        <li><a href="/services/m=forum/" class="fly"><span>Forums</span></a></li>
                        <li><a href="/services/m=hiscore/ranking.ws" class="fly"><span>Hiscores</span></a></li>
                        <li><a href="/services/m=adventurers-log/display_player_profile.html" class="fly"><span>Adventurer's Log</span></a></li>
                    </ul>
                </li>
                <li class="top"><a id="help" class="tl" href="/kbase/guid/Customer_Support.html"><span class="ts">Help</span></a>
                    <ul>
                        <li><a href="/kbase/guid/Customer_Support.html" class="fly"><span>Customer Support</span></a></li>
                        <li><a href="/parents.html" class="fly"><span>Parents' Guide</span></a></li>
                    </ul>
                </li>
                @auth
                    <li class="top">
                        <form method="post" action="/secure/m=weblogin/logout.html" style="display:inline;margin:0">
                            @csrf
                            <button type="submit" id="login" class="tl" style="background:none;border:0;cursor:pointer;color:inherit"><span class="ts">Log Out ({{ Auth::user()->displayName() }})</span></button>
                        </form>
                    </li>
                @else
                    <li class="top"><a href="/secure/m=weblogin/loginform.html" id="login" class="tl"><span class="ts">Log In</span></a></li>
                @endauth
            </ul>
            <br class="clear">
        </div>
        <div id="bannerNoad">
            <a href="/game.html" class="HoverImg" id="playBannerNoad"><img src="/img/main/skins/default/playnow-14.png" alt="Play Now"></a>
        </div>
        <div id="scroll">
            <div id="head">
                <div id="headBg">
                    <div class="navigation">
                        <div class="location"><b>Location: </b> <a href="/">Home</a> &gt; @yield('crumb', 'Page')</div>
                    </div>
                </div>
            </div>
            <div id="content">
                @yield('content')
                <br class="clear">
            </div>
            <div id="footer">
                <div class="contain">
                    <div class="footerdesc">
                        This website and its contents are copyright &copy; 1999 &ndash; {{ date('Y') }} Jagex Ltd; 2011scape is a non-commercial archive.
                        <br> Use of this website is subject to our <a href="/terms/terms.html">Terms &amp; Conditions</a> and <a href="/privacy/privacy.html">Privacy Policy</a>.
                    </div>
                    <a class="jagexlink" href="/jagex.com/index.html"><img src="/img/main/layout/jagex-14.png" alt="Jagex"></a>
                </div>
            </div>
        </div>
    </div>
    @stack('scripts')
</body>
</html>
