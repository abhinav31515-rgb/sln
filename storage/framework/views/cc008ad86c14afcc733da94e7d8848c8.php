<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['seo' => null, 'identity' => null]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['seo' => null, 'identity' => null]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
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
?>

<title><?php echo e($pageTitle); ?></title>
<meta name="description" content="<?php echo e($pageDescription); ?>">
<meta name="robots" content="<?php echo e($robots); ?>">
<link rel="canonical" href="<?php echo e($canonicalUrl); ?>">

<!-- Open Graph tags -->
<meta property="og:title" content="<?php echo e($ogTitle); ?>">
<meta property="og:description" content="<?php echo e($ogDescription); ?>">
<?php if($ogImage): ?>
<meta property="og:image" content="<?php echo e($ogImage); ?>">
<?php endif; ?>
<meta property="og:type" content="website">
<meta property="og:url" content="<?php echo e($ogUrl); ?>">

<!-- Twitter Card tags -->
<meta name="twitter:card" content="<?php echo e($twitterCard); ?>">
<meta name="twitter:title" content="<?php echo e($twitterTitle); ?>">
<meta name="twitter:description" content="<?php echo e($twitterDescription); ?>">
<?php if($ogImage): ?>
<meta name="twitter:image" content="<?php echo e($ogImage); ?>">
<?php endif; ?>

<!-- JSON-LD structured data -->
<?php if($jsonLd): ?>
<script type="application/ld+json">
<?php echo is_array($jsonLd) ? json_encode($jsonLd, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) : $jsonLd; ?>

</script>
<?php endif; ?>
<?php /**PATH C:\Users\akm96\Downloads\New folder (5)\aurum\resources\views/components/seo-head.blade.php ENDPATH**/ ?>