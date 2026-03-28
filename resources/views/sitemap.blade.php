<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
@foreach($pages as $page)
    <url>
        <loc>{{ url(route($page->route_name, [], false)) }}</loc>
        @if($page->updated_at)
        <lastmod>{{ $page->updated_at->toAtomString() }}</lastmod>
        @endif
        <changefreq>weekly</changefreq>
        <priority>{{ $page->route_name === 'home' ? '1.0' : '0.8' }}</priority>
    </url>
@endforeach
</urlset>
