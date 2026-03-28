<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['product']));

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

foreach (array_filter((['product']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div class="bg-[var(--surface)] border border-[var(--border)] rounded-[var(--radius-lg)] overflow-hidden transition-all duration-[var(--transition)] hover:-translate-y-1 hover:shadow-2xl group cursor-pointer reveal">
  <div class="aspect-square overflow-hidden relative bg-[var(--surface-alt)]">
    <?php if($product->image_url): ?>
      <img src="<?php echo e($product->image_url); ?>" alt="<?php echo e($product->name); ?>" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" loading="lazy">
    <?php else: ?>
      <div class="w-full h-full flex items-center justify-center text-[2.5rem] transition-transform duration-500 group-hover:scale-105">
        ✨
      </div>
    <?php endif; ?>
  </div>
  <div class="p-5">
    <h4 class="text-[14px] font-medium"><?php echo e($product->name); ?></h4>
    <div class="text-[var(--gold)] font-serif text-[1.3rem] font-light my-1">₹<?php echo e($product->price); ?></div>
    <div class="flex gap-2">
      <button class="flex-1 flex items-center justify-center gap-2 p-2.5 bg-[var(--surface-alt)] border border-[var(--border)] rounded-[var(--radius-md)] text-[12px] tracking-[.1em] uppercase transition-all duration-200 text-[var(--text)] hover:border-[var(--gold)] hover:text-[var(--gold)] hover:bg-[rgba(200,168,93,.06)]" @click.stop="$dispatch('add-to-cart', { productId: <?php echo e($product->id); ?> }); addToCart(event, <?php echo e($product->id); ?>)">
        <span>+ Cart</span>
      </button>
      <button class="p-2.5 bg-[var(--surface-alt)] border border-[var(--border)] rounded-[var(--radius-md)] transition-all duration-200 text-[var(--muted)] hover:border-[var(--error)] hover:text-[var(--error)]" @click.stop="showToast('Added to wishlist', 'info')">
        ♡
      </button>
    </div>
  </div>
</div>
<?php /**PATH C:\Users\akm96\Downloads\New folder (5)\aurum\resources\views/components/product-card.blade.php ENDPATH**/ ?>