@props(['product'])

<div class="bg-[var(--surface)] border border-[var(--border)] rounded-[var(--radius-lg)] overflow-hidden transition-all duration-[var(--transition)] hover:-translate-y-1 hover:shadow-2xl group cursor-pointer reveal">
  <div class="aspect-square overflow-hidden relative bg-[var(--surface-alt)]">
    @if($product->image_url)
      <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" loading="lazy">
    @else
      <div class="w-full h-full flex items-center justify-center text-[2.5rem] transition-transform duration-500 group-hover:scale-105">
        ✨
      </div>
    @endif
  </div>
  <div class="p-5">
    <h4 class="text-[14px] font-medium">{{ $product->name }}</h4>
    <div class="text-[var(--gold)] font-serif text-[1.3rem] font-light my-1">₹{{ $product->price }}</div>
    <div class="flex gap-2">
      <button class="flex-1 flex items-center justify-center gap-2 p-2.5 bg-[var(--surface-alt)] border border-[var(--border)] rounded-[var(--radius-md)] text-[12px] tracking-[.1em] uppercase transition-all duration-200 text-[var(--text)] hover:border-[var(--gold)] hover:text-[var(--gold)] hover:bg-[rgba(200,168,93,.06)]" @click.stop="$dispatch('add-to-cart', { productId: {{ $product->id }} }); addToCart(event, {{ $product->id }})">
        <span>+ Cart</span>
      </button>
      <button class="p-2.5 bg-[var(--surface-alt)] border border-[var(--border)] rounded-[var(--radius-md)] transition-all duration-200 text-[var(--muted)] hover:border-[var(--error)] hover:text-[var(--error)]" @click.stop="showToast('Added to wishlist', 'info')">
        ♡
      </button>
    </div>
  </div>
</div>
