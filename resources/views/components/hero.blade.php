@php
    $heroHeadline = $identity?->get('hero_headline') ?? 'Where beauty<br/>becomes a <em class="italic text-[var(--gold)]">ritual</em>';
    $heroSubheadline = $identity?->get('hero_subheadline') ?? 'Immerse yourself in bespoke treatments, curated by master therapists — a sanctuary of elegance in the heart of the city.';
    $heroCtaLabel = $identity?->get('hero_cta_label') ?? 'Book a Treatment';
    $stat1Value = $identity?->get('hero_stat_1_value') ?? '12+';
    $stat1Label = $identity?->get('hero_stat_1_label') ?? 'Years of Excellence';
    $stat2Value = $identity?->get('hero_stat_2_value') ?? '50+';
    $stat2Label = $identity?->get('hero_stat_2_label') ?? 'Signature Services';
    $stat3Value = $identity?->get('hero_stat_3_value') ?? '4.9★';
    $stat3Label = $identity?->get('hero_stat_3_label') ?? 'Client Rating';
    $stat4Value = $identity?->get('hero_stat_4_value') ?? '8K+';
    $stat4Label = $identity?->get('hero_stat_4_label') ?? 'Happy Clients';
@endphp

<section id="hero" class="relative min-h-screen flex items-center overflow-hidden">
  <div class="absolute inset-0 bg-gradient-to-br from-[#0d0d0d] via-[#1A1A1A] to-[#1f1a12]"></div>
  <div class="absolute inset-0 opacity-[0.035] pointer-events-none" style="background-image:url('data:image/svg+xml,%3Csvg viewBox=\'0 0 256 256\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cfilter id=\'n\'%3E%3CfeTurbulence type=\'fractalNoise\' baseFrequency=\'.65\' numOctaves=\'3\' stitchTiles=\'stitch\'/%3E%3C/filter%3E%3Crect width=\'100%25\' height=\'100%25\' filter=\'url(%23n)\'/%3E%3C/svg%3E');"></div>
  
  <div class="absolute rounded-full blur-[80px] pointer-events-none w-[600px] h-[600px] -top-[100px] -right-[100px]" style="background:radial-gradient(circle,rgba(200,168,93,.12) 0%,transparent 70%);"></div>
  <div class="absolute rounded-full blur-[80px] pointer-events-none w-[400px] h-[400px] -bottom-[50px] -left-[50px]" style="background:radial-gradient(circle,rgba(200,168,93,.06) 0%,transparent 70%);"></div>
  
  <div class="container relative z-10 pt-[8rem] pb-[6rem]">
    <div class="max-w-[780px]">
      <div class="flex items-center gap-3 mb-6 reveal">
        <div class="w-10 h-px bg-[var(--gold)]"></div>
        <span class="text-[13px] tracking-[.15em] uppercase font-normal" style="color:var(--gold)">{{ $identity?->get('tagline') ?? 'Luxury Unisex Salon' }}</span>
      </div>
      
      <h1 class="h1 mb-5 reveal">
        {!! $heroHeadline !!}
      </h1>
      
      <p class="text-[1.05rem] text-[var(--muted)] max-w-[480px] mb-10 leading-[1.8] reveal">
        {{ $heroSubheadline }}
      </p>
      
      <div class="flex flex-wrap gap-4 mb-12 reveal">
        <button class="btn btn-primary" onclick="openBooking()">{{ $heroCtaLabel }}</button>
        <a href="#rituals" class="btn btn-outline">Explore Rituals</a>
      </div>
      
      <div class="flex flex-wrap gap-8 reveal">
        <div>
          <div class="font-serif text-[2rem] font-light text-[var(--gold)]">{{ $stat1Value }}</div>
          <div class="text-[11px] tracking-[.12em] uppercase text-[var(--muted)] mt-1">{{ $stat1Label }}</div>
        </div>
        <div>
          <div class="font-serif text-[2rem] font-light text-[var(--gold)]">{{ $stat2Value }}</div>
          <div class="text-[11px] tracking-[.12em] uppercase text-[var(--muted)] mt-1">{{ $stat2Label }}</div>
        </div>
        <div>
          <div class="font-serif text-[2rem] font-light text-[var(--gold)]">{{ $stat3Value }}</div>
          <div class="text-[11px] tracking-[.12em] uppercase text-[var(--muted)] mt-1">{{ $stat3Label }}</div>
        </div>
        <div>
          <div class="font-serif text-[2rem] font-light text-[var(--gold)]">{{ $stat4Value }}</div>
          <div class="text-[11px] tracking-[.12em] uppercase text-[var(--muted)] mt-1">{{ $stat4Label }}</div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 text-[var(--muted)] text-[11px] tracking-[.15em] uppercase cursor-pointer hover:text-[var(--gold)] transition-colors duration-200" onclick="document.querySelector('#quick-book').scrollIntoView({behavior:'smooth'})">
    <div class="w-px h-[40px] bg-gradient-to-b from-[var(--gold)] to-transparent animate-[scrollLine_2s_ease-in-out_infinite]"></div>
    <span>Scroll</span>
  </div>
</section>
