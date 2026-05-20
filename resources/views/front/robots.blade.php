User-agent: *
@if($noindex)
Disallow: /
@else
Disallow: /admin/
Disallow: /storage/
Allow: /
@endif

Sitemap: {{ url('/sitemap.xml') }}
