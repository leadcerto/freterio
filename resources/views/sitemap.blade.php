<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

    {{-- Página inicial --}}
    <url>
        <loc>{{ url('/') }}</loc>
        <changefreq>weekly</changefreq>
        <priority>1.0</priority>
    </url>

    {{-- Todas as variações de URL por bairro --}}
    @foreach($neighborhoods as $neighborhood)
        @foreach($patterns as $pattern)
        <url>
            <loc>{{ url($pattern->buildUrl($neighborhood->slug)) }}</loc>
            <lastmod>{{ $neighborhood->updated_at->toDateString() }}</lastmod>
            <changefreq>monthly</changefreq>
            <priority>0.8</priority>
        </url>
        @endforeach
    @endforeach

</urlset>
