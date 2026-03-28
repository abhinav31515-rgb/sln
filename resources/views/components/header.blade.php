@php
    $brandName = $identity?->get('brand_name') ?? 'AURUM';
    $accentIndex = (int)($identity?->get('brand_accent_index') ?? 1);
    $brandChars = mb_str_split($brandName);
@endphp

<header id="header" class="fixed top-0 left-0 right-0 z-[900] py-5 transition-all duration-500">
  <div class="container mx-auto px-6 max-w-[1280px]">
    <nav class="flex items-center justify-between gap-8">
      <a href="#" class="font-serif text-[1.7rem] font-light tracking-[.25em] uppercase">
        @foreach($brandChars as $index => $char)
          @if($index === $accentIndex)
            <span class="text-[var(--gold)]">{{ $char }}</span>
          @else
            {{ $char }}
          @endif
        @endforeach
      </a>
      
      <ul class="hidden lg:flex items-center gap-8">
        <li><a href="#services" class="nav-link">Services</a></li>
        <li><a href="#rituals" class="nav-link">Rituals</a></li>
        <li><a href="#therapists" class="nav-link">Team</a></li>
        <li><a href="#boutique" class="nav-link">Boutique</a></li>
        <li><a href="#offers" class="nav-link">Offers</a></li>
        <li><a href="#journal" class="nav-link">Journal</a></li>
        <li><a href="#contact" class="nav-link">Contact</a></li>
      </ul>
      
      <div class="flex items-center gap-3">
        <button class="btn btn-ghost btn-icon" id="cart-btn" title="Cart" aria-label="Open cart">
          🛍️ <span id="cart-count" class="text-[11px] bg-[var(--gold)] text-[var(--bg)] rounded-full py-0.5 px-1.5 ml-1">0</span>
        </button>
        <button class="btn btn-primary lg:hidden" id="nav-book-btn" onclick="openBooking()" aria-label="Book appointment">Book</button>
        <button class="btn btn-primary hidden lg:inline-flex" onclick="openBooking()" id="nav-book-desktop" aria-label="Book appointment now">Book Now</button>
        
        <button class="hamburger lg:hidden flex flex-col gap-[5px] w-6 p-2 cursor-pointer" id="hamburger-btn" aria-label="Menu">
          <span class="h-px bg-[var(--text)] transition-transform duration-300"></span>
          <span class="h-px bg-[var(--text)] transition-opacity duration-300"></span>
          <span class="h-px bg-[var(--text)] transition-transform duration-300"></span>
        </button>
        
        @auth
          @if(Auth::user()->isAdmin())
        <a href="/admin/dashboard" class="btn btn-ghost btn-icon text-[.85rem]" title="Admin" aria-label="Admin panel">⚙️</a>
          @endif
        @endauth
      </div>
    </nav>
  </div>
</header>
