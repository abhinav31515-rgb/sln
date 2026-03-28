@php
    $brandName = $identity?->get('brand_name') ?? 'AURUM';
    $accentIndex = (int)($identity?->get('brand_accent_index') ?? 1);
    $brandChars = mb_str_split($brandName);
    $footerTagline = $identity?->get('footer_tagline') ?? 'Where every visit is a ceremony — a quiet luxury experience designed to restore, elevate and inspire.';
    $copyrightSuffix = $identity?->get('footer_copyright_suffix') ?? 'Studio Pvt. Ltd. All rights reserved.';
    $city = $identity?->get('city') ?? 'Gurugram';
    $socialInstagram = $identity?->get('social_instagram') ?? '#';
    $socialTwitter = $identity?->get('social_twitter') ?? '#';
    $socialYoutube = $identity?->get('social_youtube') ?? '#';
    $socialLinkedin = $identity?->get('social_linkedin') ?? '#';
@endphp

<footer class="bg-[var(--surface)] border-t border-[var(--border)] pt-16 pb-8">
  <div class="container mx-auto px-6 max-w-[1280px]">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-[2fr_1fr_1fr_1fr] gap-10 mb-12">
      <div class="flex flex-col gap-4">
        <span class="font-serif text-[1.5rem] font-light tracking-[.25em] uppercase">
          @foreach($brandChars as $index => $char)
            @if($index === $accentIndex)
              <span class="text-[var(--gold)]">{{ $char }}</span>
            @else
              {{ $char }}
            @endif
          @endforeach
        </span>
        <p class="text-[var(--muted)] text-[14px] leading-[1.8] max-w-[280px]">{{ $footerTagline }}</p>
        <div class="flex gap-3">
          <a href="{{ $socialInstagram }}" class="social-btn" aria-label="Instagram">📸</a>
          <a href="{{ $socialTwitter }}" class="social-btn" aria-label="Twitter">🐦</a>
          <a href="{{ $socialYoutube }}" class="social-btn" aria-label="YouTube">▶️</a>
          <a href="{{ $socialLinkedin }}" class="social-btn" aria-label="LinkedIn">🔗</a>
        </div>
      </div>
      
      <div class="footer-col">
        <h5 class="text-[12px] tracking-[.15em] uppercase text-[var(--gold)] mb-4">Services</h5>
        <ul class="flex flex-col gap-2">
          <li><a href="#" class="text-[14px] text-[var(--muted)] hover:text-[var(--text)] transition-colors">Hair Couture</a></li>
          <li><a href="#" class="text-[14px] text-[var(--muted)] hover:text-[var(--text)] transition-colors">Signature Facials</a></li>
          <li><a href="#" class="text-[14px] text-[var(--muted)] hover:text-[var(--text)] transition-colors">Body Rituals</a></li>
          <li><a href="#" class="text-[14px] text-[var(--muted)] hover:text-[var(--text)] transition-colors">Nail Atelier</a></li>
          <li><a href="#" class="text-[14px] text-[var(--muted)] hover:text-[var(--text)] transition-colors">Bridal Suite</a></li>
        </ul>
      </div>
      
      <div class="footer-col">
        <h5 class="text-[12px] tracking-[.15em] uppercase text-[var(--gold)] mb-4">Company</h5>
        <ul class="flex flex-col gap-2">
          <li><a href="#" class="text-[14px] text-[var(--muted)] hover:text-[var(--text)] transition-colors">About Us</a></li>
          <li><a href="#" class="text-[14px] text-[var(--muted)] hover:text-[var(--text)] transition-colors">Our Team</a></li>
          <li><a href="#" class="text-[14px] text-[var(--muted)] hover:text-[var(--text)] transition-colors">Careers</a></li>
          <li><a href="#" class="text-[14px] text-[var(--muted)] hover:text-[var(--text)] transition-colors">Press</a></li>
          <li><a href="#" class="text-[14px] text-[var(--muted)] hover:text-[var(--text)] transition-colors">Partnerships</a></li>
        </ul>
      </div>
      
      <div class="footer-col">
        <h5 class="text-[12px] tracking-[.15em] uppercase text-[var(--gold)] mb-4">Legal</h5>
        <ul class="flex flex-col gap-2">
          <li><a href="#" class="text-[14px] text-[var(--muted)] hover:text-[var(--text)] transition-colors">Privacy Policy</a></li>
          <li><a href="#" class="text-[14px] text-[var(--muted)] hover:text-[var(--text)] transition-colors">Terms of Use</a></li>
          <li><a href="#" class="text-[14px] text-[var(--muted)] hover:text-[var(--text)] transition-colors">Cancellation</a></li>
          <li><a href="#" class="text-[14px] text-[var(--muted)] hover:text-[var(--text)] transition-colors">Refund Policy</a></li>
        </ul>
      </div>
    </div>
    
    <div class="pt-6 border-t border-[var(--border)] flex flex-wrap justify-between items-center gap-4 text-[12px] text-[var(--muted)]">
      <span>© {{ date('Y') }} {{ $brandName }} {{ $copyrightSuffix }}</span>
      <span>Crafted with intention in {{ $city }}</span>
    </div>
  </div>
</footer>
