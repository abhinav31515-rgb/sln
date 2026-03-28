<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['service']));

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

foreach (array_filter((['service']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div class="relative overflow-hidden rounded-[var(--radius-lg)] aspect-[3/4] cursor-pointer group reveal" @click="$dispatch('open-booking', { serviceId: <?php echo e($service->id); ?> })">
  <?php if($service->image_url): ?>
    <img src="<?php echo e($service->image_url); ?>" alt="<?php echo e($service->name); ?>" class="w-full h-full object-cover transition-transform duration-[600ms] ease-[cubic-bezier(.25,.46,.45,.94)] group-hover:scale-105" loading="lazy">
  <?php else: ?>
    <div class="w-full h-full flex items-center justify-center text-[3rem] shrink-0 transition-transform duration-[600ms] ease-[cubic-bezier(.25,.46,.45,.94)] group-hover:scale-105 bg-gradient-to-br from-[var(--surface)] to-[var(--surface-alt)]">
      🌸
    </div>
  <?php endif; ?>
  
  <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/40 to-transparent flex flex-col justify-end p-6">
    <div class="text-[var(--gold)] text-[13px] tracking-[.1em] mb-1.5">₹<?php echo e($service->price); ?></div>
    <h3 class="h4 text-[var(--text)] font-serif"><?php echo e($service->name); ?></h3>
    <div class="text-[var(--muted)] text-[12px] mt-1"><?php echo e($service->duration_minutes); ?> min · <?php echo e($service->description); ?></div>
  </div>
</div>
<?php /**PATH C:\Users\akm96\Downloads\New folder (5)\aurum\resources\views/components/service-card.blade.php ENDPATH**/ ?>