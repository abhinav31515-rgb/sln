@props(['service'])

<div class="relative overflow-hidden rounded-[var(--radius-lg)] aspect-[3/4] cursor-pointer group reveal" @click="$dispatch('open-booking', { serviceId: {{ $service->id }} })">
  @if($service->image_url)
    <img src="{{ $service->image_url }}" alt="{{ $service->name }}" class="w-full h-full object-cover transition-transform duration-[600ms] ease-[cubic-bezier(.25,.46,.45,.94)] group-hover:scale-105" loading="lazy">
  @else
    <div class="w-full h-full flex items-center justify-center text-[3rem] shrink-0 transition-transform duration-[600ms] ease-[cubic-bezier(.25,.46,.45,.94)] group-hover:scale-105 bg-gradient-to-br from-[var(--surface)] to-[var(--surface-alt)]">
      🌸
    </div>
  @endif
  
  <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/40 to-transparent flex flex-col justify-end p-6">
    <div class="text-[var(--gold)] text-[13px] tracking-[.1em] mb-1.5">₹{{ $service->price }}</div>
    <h3 class="h4 text-[var(--text)] font-serif">{{ $service->name }}</h3>
    <div class="text-[var(--muted)] text-[12px] mt-1">{{ $service->duration_minutes }} min · {{ $service->description }}</div>
  </div>
</div>
