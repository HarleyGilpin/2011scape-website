{{-- Opens the bodyBackgroundHead chrome chain. Yields `crumb` for breadcrumb. --}}
<a name="top"></a>
<div class="bodyBackgroundHead">
    <div id="menubox">
        @include('layouts._partials.menu')
    </div>
    <div id="bannerNoad">
        <a href="/play" class="HoverImg" id="playBannerNoad"><img src="/img/main/skins/default/playnow-14.png" alt="Play Now"></a>
    </div>
    <div id="scroll">
        <div id="head">
            <div id="headBg">
                <div id="langAndLogin">
                    <div id="lang"><a href="#"><img alt="English" title="English" src="/img/main/layout/en.gif"></a></div>
                </div>
                <div class="navigation">
                    <div class="location">
                        <b>Location: </b> <a href="/">Home</a>@hasSection('crumb') &gt; @yield('crumb')@endif
                    </div>
                </div>
            </div>
        </div>
        <div id="content">
