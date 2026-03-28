<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['therapist']));

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

foreach (array_filter((['therapist']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div class="text-center p-8 bg-[var(--surface)] border border-[var(--border)] rounded-[var(--radius-lg)] transition-all duration-500 hover:-translate-y-1 hover:shadow-2xl reveal">
  <div class="w-[90px] h-[90px] rounded-full mx-auto mb-4 bg-[var(--surface-alt)] border-2 border-[var(--gold)] flex items-center justify-center text-[2rem] overflow-hidden">
    <?php if($therapist->avatar_url): ?>
      <img src="<?php echo e($therapist->avatar_url); ?>" alt="<?php echo e($therapist->user->name ?? 'Therapist'); ?>" class="w-full h-full object-cover">
    <?php else: ?>
      👩‍⚕️
    <?php endif; ?>
  </div>
  <h4 class="h4 font-serif"><?php echo e($therapist->user->name ?? 'Specialist'); ?></h4>
  <div class="text-[var(--gold)] text-[12px] tracking-[.1em] uppercase my-1.5"><?php echo e($therapist->specialty); ?></div>
  <p class="text-[var(--muted)] text-[13px] leading-[1.7] mb-4"><?php echo e($therapist->bio); ?></p>
  <button class="btn btn-outline w-full" @click="$dispatch('open-booking', { therapistId: <?php echo e($therapist->id); ?> })">Book Session</button>
</div>
<?php /**PATH C:\Users\akm96\Downloads\New folder (5)\aurum\resources\views/components/therapist-card.blade.php ENDPATH**/ ?>