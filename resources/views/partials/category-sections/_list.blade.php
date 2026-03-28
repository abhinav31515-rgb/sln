@props(['section'])

<section class="py-24 bg-[var(--bg)]">
  <div class="container mx-auto px-6 max-w-[1280px]">
    <div class="mb-12">
      @if($section->category)
        <span class="text-[12px] tracking-[.25em] text-[var(--gold)] uppercase mb-4 inline-block">{{ $section->category->name }}</span>
      @endif
      <h2 class="h2 font-serif">{{ $section->heading }}</h2>
      @if($section->sub_heading)
        <p class="text-[var(--muted)] mt-4 max-w-2xl">{{ $section->sub_heading }}</p>
      @endif
    </div>
    
    <div class="space-y-6">
      @foreach($section->services->sortBy('pivot.sort_order') as $service)
        <div class="flex flex-col md:flex-row gap-6 bg-[var(--surface)] border border-[var(--border)] rounded-[var(--radius-lg)] overflow-hidden hover:shadow-xl transition-all duration-300 cursor-pointer group" @click="$dispatch('open-booking', { serviceId: {{ $service->id }} })">
          <div class="md:w-[280px] h-[200px] md:h-auto flex-shrink-0 bg-[var(--surface-alt)] relative overflow-hidden">
            @if($service->image_url)
              <img src="{{ $service->image_url }}" alt="{{ $service->name }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" loading="lazy">
            @else
              <div class="w-full h-full flex items-center justify-center text-[3rem]">🌸</div>
            @endif
          </div>
          <div class="flex-1 p-6 flex flex-col justify-center">
            <h3 class="h3 font-serif mb-2">{{ $service->name }}</h3>
            <p class="text-[var(--muted)] text-[14px] leading-relaxed mb-4">{{ $service->description }}</p>
            <div class="flex items-center gap-6 text-[13px]">
              <span class="text-[var(--gold)] font-serif text-[1.2rem]">₹{{ $service->price }}</span>
              <span class="text-[var(--muted)]">{{ $service->duration_minutes }} minutes</span>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>
