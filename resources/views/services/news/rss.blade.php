<?php echo '<?xml version="1.0" encoding="UTF-8"?>'."\n"; ?>
<rss version="2.0">
<channel>
    <title>RuneScape News</title>
    <link>{{ url('/') }}</link>
    <description>Latest news from 2011scape.</description>
    <language>en</language>
    @foreach ($items as $item)
    <item>
        <title>{!! e($item->title) !!}</title>
        <link>{{ url('services/m='.'news/'.$item->slug.'.html') }}</link>
        <guid isPermaLink="true">{{ url('services/m='.'news/'.$item->slug.'.html') }}</guid>
        @if ($item->published_at)<pubDate>{{ $item->published_at->toRfc822String() }}</pubDate>@endif
        <description>{!! e($item->summary ?? strip_tags($item->body_html)) !!}</description>
    </item>
    @endforeach
</channel>
</rss>
