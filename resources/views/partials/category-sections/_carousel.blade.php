@props(['section'])

<section class="py-24 bg-[var(--surface)]">
  <div class="container mx-auto px-6 max-w-[1280px]">
    <div class="mb-12 text-center">
      @if($section->category)
        <span class="text-[12px] tracking-[.25em] text-[var(--gold)] uppercase mb-4 inline-block">{{ $section->category->name }}</span>
      @endif
      <h2 class="h2 font-serif">{{ $section->heading }}</h2>
      @if($section->sub_heading)
        <p class="text-[var(--muted)] mt-4 max-w-2xl mx-auto">{{ $section->sub_heading }}</p>
      @endif
    </div>
    
    <div class="overflow-x-auto pb-4 -mx-6 px-6">
      <div class="flex gap-6 min-w-max">
        @foreach($section->services->sortBy('pivot.sort_order') as $service)
          <div class="w-[320px] flex-shrink-0">
            <x-service-card :service="$service" />
          </div>
        @endforeach
      </div>
    </div>
  </div>
</section>
