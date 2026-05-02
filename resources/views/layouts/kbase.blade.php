<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link href="/css/global-38.css" rel="stylesheet">
    <link href="/css/kbase-32.css" rel="stylesheet">
    <link href="/css/news-3.css" rel="stylesheet">
    <title>@yield('title', 'RuneScape Knowledge Base')</title>
    <link rel="icon" type="image/vnd.microsoft.icon" href="/favicon.ico">
</head>
<body class="kbase-page">
    <div id="page-wrap">
        <div id="header"><a href="/"><img src="/img/banner-runescape.png" alt="RuneScape"></a></div>
        <nav id="kbase-search-bar">
            <form action="/kbase/search.html" method="get">
                <input type="search" name="q" placeholder="Search knowledge base" value="{{ request('q') }}">
                <button type="submit">Search</button>
            </form>
        </nav>
        <main id="content">
            @yield('content')
        </main>
        <footer id="footer"><p><a href="/">Back to home</a></p></footer>
    </div>
</body>
</html>
