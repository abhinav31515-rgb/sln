@props(['seo' => null, 'identity' => null])

@php
    // Fallback to identity values when SEO record doesn't exist
    $pageTitle = $seo?->title ?? ($identity?->get('brand_name') . ' — ' . $identity?->get('tagline'));
    $pageDescription = $seo?->description ?? $identity?->get('tagline');
    $ogTitle = $seo?->og_title ?? $pageTitle;
    $ogDescription = $seo?->og_description ?? $pageDescription;
    $ogImage = $seo?->og_image ?? null;
    $ogUrl = $seo?->canonical_url ?? url()->current();
    $twitterCard = $seo?->twitter_card ?? 'summary_large_image';
    $twitterTitle = $seo?->twitter_title ?? $ogTitle;
    $twitterDescription = $seo?->twitter_description ?? $ogDescription;
    $robots = $seo?->robots ?? 'index, follow';
    $canonicalUrl = $seo?->canonical_url ?? url()->current();
    $jsonLd = $seo?->json_ld ?? null;
@endphp

<title>{{ $pageTitle }}</title>
<meta name="description" content="{{ $pageDescription }}">
<meta name="robots" content="{{ $robots }}">
<link rel="canonical" href="{{ $canonicalUrl }}">

<!-- Open Graph tags -->
<meta property="og:title" content="{{ $ogTitle }}">
<meta property="og:description" content="{{ $ogDescription }}">
@if($ogImage)
<meta property="og:image" content="{{ $ogImage }}">
@endif
<meta property="og:type" content="website">
<meta property="og:url" content="{{ $ogUrl }}">

<!-- Twitter Card tags -->
<meta name="twitter:card" content="{{ $twitterCard }}">
<meta name="twitter:title" content="{{ $twitterTitle }}">
<meta name="twitter:description" content="{{ $twitterDescription }}">
@if($ogImage)
<meta name="twitter:image" content="{{ $ogImage }}">
@endif

<!-- JSON-LD structured data -->
@if($jsonLd)
<script type="application/ld+json">
{!! is_array($jsonLd) ? json_encode($jsonLd, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) : $jsonLd !!}
</script>
@endif
