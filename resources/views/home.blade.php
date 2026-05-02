<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/vnd.microsoft.icon" href="/favicon.ico">
    <link rel="apple-touch-icon" href="/img/mobile.png">
    <link href="/css/rs2010/global-2.css" rel="stylesheet">
    <link href="/css/rs2010/oldmenu-5.css" rel="stylesheet">
    <link href="/css/rs2010/title-5.css" rel="stylesheet">
    <link href="/jagex.com/css/shadowbox/shadowbox-0.css" rel="stylesheet">
    <script type="text/javascript" src="/jagex.com/js/jquery/jquery_1_4_2.js"></script>
    <script type="text/javascript" src="/jagex.com/js/jquery/jquery_placeholder_0_9.js"></script>
    <script type="text/javascript" src="/jagex.com/js/jquery/jquery_arturoSlider_0_9_3.js"></script>
    <script type="text/javascript" src="/jagex.com/js/jquery/jquery_elide_1_1.js"></script>
    <script src="/css/rs2010/globaljs-1.js"></script>
    <script src="/css/rs2010/titlejs-3.js"></script>
    <title>2011scape - The No.1 Free Online Multiplayer Game</title>
    <meta name="description" content="Play 2011scape for free, and join a global community of adventurers as you complete quests and win enormous treasures in a 3D world full of magic and monsters.">
</head>
<body class="title">
<div class="BgContent">
    <div class="BgHead">
        <div class="BgFoot">
            <div class="BgWidth">
                <a name="top"></a>
                <header>
                    <div id="header">
                        <h1><span>2011scape - </span>The World's Most Popular Free MMORPG</h1>
                        <a id="playnow" class="HoverImg" href="/play"><img src="/img/main/home2010/play.jpg" alt="Play Now"></a>
                        <span id="playerCount">@if (! empty($online) && $online > 0){{ number_format($online) }} people currently online @else 2011scape archive — non-commercial server @endif</span>
                        <form id="headerSearch" action="/kb" method="get">
                            <input type="text" name="q" placeholder="Search knowledge base...">
                            <div class="HoverImg">
                                <button type="submit"><img src="/img/main/home2010/headerSearchButton.jpg" alt="Search"></button>
                            </div>
                        </form>
                    </div>
                </header>

                <nav>
                    <div id="menubox">
                        @include('layouts._partials.menu')
                    </div>
                </nav>

                <div class="PageBody1"><div class="PageBody2"><div class="PageFoot"><div class="PageHead">
                    <div id="left">

                        {{-- Slider --}}
                        <div id="slider" class="Shadow sliderJS">
                            <div class="Shadow"></div>
                            <div class="Caster">
                                @foreach ($slides as $slide)
                                    <img class="slide" src="{{ $slide['image'] }}" alt="">
                                @endforeach
                                <div id="slideCaption"></div>
                                @foreach ($slides as $i => $slide)
                                    <a href="{{ $slide['href'] }}" class="caption" @if ($i > 0) style="display:none" @endif>
                                        <h3>{{ $slide['title'] }}</h3>
                                        <span>{{ $slide['caption'] }}</span>
                                    </a>
                                @endforeach
                                <div id="sliderControls">
                                    <a href="#" id="sliderPrev"><span>prev</span></a>
                                    <ul id="sliderList">
                                        @foreach ($slides as $i => $slide)
                                            <a href="#" @if ($i === 0) class="current" @endif><span>{{ $i + 1 }}</span></a>
                                        @endforeach
                                    </ul>
                                    <a href="#" id="sliderNext"><span>next</span></a>
                                </div>
                            </div>
                        </div>

                        {{-- News tabs --}}
                        <div id="news" class="Shadow">
                            <div class="Shadow"></div>
                            <div class="Caster">
                                <a href="#latest" class="newsTab newsTabSelected" id="newsTabLatest">Latest News</a>
                                <a href="#devblog" class="newsTab" id="newsTabDevblog">Dev Blogs</a>
                                <a href="#articles" class="newsTab" id="newsTabArticles">Articles</a>

                                {{-- Latest News pane --}}
                                <div class="newsContent newsContentSelected">
                                    @forelse ($news as $i => $item)
                                        <a href="/news/{{ $item->slug }}" class="newsItem @if ($i === 0) newsItemSelected @endif">
                                            <h3>
                                                <img class="newsIcon" src="/img/news/icons/wilderness_vote-1.jpg" alt="">
                                                <span class="newsTitle">{{ $item->title }}</span>
                                                @if ($item->published_at)<span class="newsPosted">Posted {{ $item->published_at->format('d-M-Y') }}</span>@endif
                                            </h3>
                                            <img class="newsImage" src="/img/news/icons/wilderness_vote-1.jpg" alt="">
                                            <p>{{ $item->summary ?: \Illuminate\Support\Str::limit(strip_tags($item->body_html), 220) }}</p>
                                            @if ($item->published_at)
                                                <div class="newsFlag">{{ $item->published_at->format('M') }}<br>{{ $item->published_at->format('j') }}</div>
                                            @endif
                                            <span class="newsExpand Olde">More &gt;</span>
                                        </a>
                                    @empty
                                        <p style="padding:1em">No news yet. <a href="/news">View archive</a></p>
                                    @endforelse
                                    <a href="/news.rss" class="newsRSS Olde"><span>RSS</span> <img src="/img/main/home2010/rss_icon.png" alt="RSS"></a>
                                    <a href="/news" class="newsMore">Even more News &gt;</a>
                                </div>

                                {{-- Dev Blogs pane --}}
                                <div class="newsContent">
                                    @forelse ($devblogs as $i => $post)
                                        <a href="/devblog/{{ $post->slug }}" class="newsItem @if ($i === 0) newsItemSelected @endif">
                                            <h3>
                                                <img class="newsIcon" src="/services/m=devblog/images/icon/dev-1.png" alt="">
                                                <span class="newsTitle">{{ $post->title }}</span>
                                                @if ($post->published_at)<span class="newsPosted">Posted {{ $post->published_at->format('d-M-Y') }}</span>@endif
                                            </h3>
                                            <img class="newsImage" src="/services/m=devblog/images/icon/dev-1.png" alt="">
                                            <p>{{ \Illuminate\Support\Str::limit(strip_tags($post->body_html), 220) }}</p>
                                            <span class="newsExpand Olde">More &gt;</span>
                                        </a>
                                    @empty
                                        <p style="padding:1em">No dev blog posts yet. <a href="/devblog">View archive</a></p>
                                    @endforelse
                                    <a href="/devblog" class="newsMore">Even more Developers' Blogs &gt;</a>
                                </div>

                                {{-- Articles pane --}}
                                <div class="newsContent">
                                    @foreach ($articles as $i => $article)
                                        <a href="/kb/{{ $article->slug }}" class="newsItem @if ($i === 0) newsItemSelected @endif newsItemNoFlag">
                                            <h3>
                                                <img class="newsIcon" src="/img/main/home2010/articles/areaguides.jpg" alt="">
                                                <span class="newsTitle">{{ $article->title }}</span>
                                            </h3>
                                            <img class="newsImage" src="/img/main/home2010/articles/areaguides.jpg" alt="">
                                            <p>{{ \Illuminate\Support\Str::limit($article->search_text ?? strip_tags($article->body_html), 200) }}</p>
                                            <span class="newsExpand Olde">More &gt;</span>
                                        </a>
                                    @endforeach
                                    <a href="/kb" class="newsMore">Browse all articles &gt;</a>
                                </div>
                            </div>
                        </div>

                        {{-- Hot Forum Topics --}}
                        <a name="hot"></a>
                        <div id="hotTopics" class="community Shadow">
                            <div class="Shadow"></div>
                            <div class="Caster">
                                <a href="/services/m=forum/" class="communityTitle"><h2>Hot Forum Topics</h2></a>
                                @if (! empty($xfThreads))
                                    @foreach ($xfThreads as $t)
                                        <a href="{{ $t['view_url'] }}" class="hot">
                                            <span class="hotImage">
                                                <img src="/services/m=config-manager/hottopics/img/news_announcements_2.gif" alt="">
                                                <span></span>
                                            </span>
                                            <h3>{{ $t['title'] }}</h3>
                                            @if ($t['username']) Posted by {{ $t['username'] }} @endif
                                            @if ($t['last_post_date']) on {{ \Illuminate\Support\Carbon::createFromTimestamp($t['last_post_date'])->format('d-M-Y') }} @endif
                                        </a>
                                    @endforeach
                                @else
                                    @foreach ($hottopics as $topic)
                                        <a href="{{ $topic->url }}" class="hot">
                                            <span class="hotImage">
                                                @if ($topic->image)<img src="{{ $topic->image }}" alt="">@endif
                                                <span></span>
                                            </span>
                                            <h3>{{ $topic->label }}</h3>
                                            @if ($topic->byline){{ $topic->byline }}@endif
                                        </a>
                                    @endforeach
                                @endif
                                <a href="/services/m=forum/" class="communityMore">Visit Forums &gt;</a>
                            </div>
                        </div>

                        @include('_partials.poll', ['poll' => $poll, 'voted' => $voted])
                    </div>{{-- /#left --}}

                    {{-- Featured tiles right column --}}
                    <div id="right">
                        <div id="Shadow1"></div>
                        @foreach ($features as $f)
                            <a class="feature Shadow" id="{{ $f['id'] }}" href="{{ $f['href'] }}">
                                <div class="Shadow"></div>
                                <div class="Caster">
                                    <span class="featureImg"><span></span></span>
                                    <h3>{{ $f['title'] }}</h3>
                                    <p>{{ $f['desc'] }} - <span>{{ $f['cta'] }}&nbsp;&gt;</span></p>
                                    <span class="featureTip"></span>
                                </div>
                            </a>
                        @endforeach
                    </div>

                    <p id="pageFooter">
                        <a href="/kb">About Us</a> |
                        <a href="/privacy">Privacy Policy</a> |
                        <a href="/terms">Terms &amp; Conditions</a> |
                        <a href="/support">Customer Support</a>
                        <br>
                        <a href="#top">^ top of page ^</a>
                    </p>
                </div></div></div></div>
            </div>
        </div>
    </div>
</div>

<div id="Footer">
    <footer>
        <div id="Explore">
            <h2 class="Olde">Explore 2011scape</h2>
            <form id="FooterSearch" action="/kb" method="get">
                <input type="text" name="q" placeholder="Search knowledge base...">
                <button type="submit"><img src="/img/global/FooterSearchButton.jpg" alt="Search"></button>
            </form>
            <p>This website is a non-commercial archive. &copy; 1999 &ndash; {{ date('Y') }} Jagex Ltd / 2011scape Team.</p>
        </div>
    </footer>
</div>

{{-- arturoSlider init --}}
<script>
$(function () {
    if ($('#slider').length && $.fn.arturoSlider) {
        $('#slider').arturoSlider({ duration: 6000, captionFade: true });
    }

    // Tab switcher
    $('.newsTab').click(function (e) {
        e.preventDefault();
        var idx = $(this).index('.newsTab');
        $('.newsTab').removeClass('newsTabSelected');
        $(this).addClass('newsTabSelected');
        $('.newsContent').removeClass('newsContentSelected').eq(idx).addClass('newsContentSelected');
    });
});
</script>
</body>
</html>
