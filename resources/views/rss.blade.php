<?=
'<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL
?>
<rss version="2.0">
    <channel>
    <title>James Sparrow</title>
    <description>Updates from James Sparrow</description>
    <language>en</language>
    <link>https://jsparrow.uk/feed</link>
    <image>
        <title>James Sparrow</title>
        <url>https://jsparrow.uk/portrait.png</url>
        <link>https://jsparrow.uk/feed</link>
    </image>

@foreach ($posts as $item)
<item>
    <title>{{$item->title}}</title>
    <guid>https://jsparrow.uk/{{$item->slug}}</guid>
    <link>https://jsparrow.uk/{{$item->slug}}</link>
    <pubDate>{{$item->updated_at}}</pubDate>
    <description>{{$item->body}}</description>
    </item>
@endforeach

</channel>
</rss>