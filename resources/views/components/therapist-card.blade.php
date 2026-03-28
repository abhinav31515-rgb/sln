@props(['therapist'])

<div class="text-center p-8 bg-[var(--surface)] border border-[var(--border)] rounded-[var(--radius-lg)] transition-all duration-500 hover:-translate-y-1 hover:shadow-2xl reveal">
  <div class="w-[90px] h-[90px] rounded-full mx-auto mb-4 bg-[var(--surface-alt)] border-2 border-[var(--gold)] flex items-center justify-center text-[2rem] overflow-hidden">
    @if($therapist->avatar_url)
      <img src="{{ $therapist->avatar_url }}" alt="{{ $therapist->user->name ?? 'Therapist' }}" class="w-full h-full object-cover">
    @else
      👩‍⚕️
    @endif
  </div>
  <h4 class="h4 font-serif">{{ $therapist->user->name ?? 'Specialist' }}</h4>
  <div class="text-[var(--gold)] text-[12px] tracking-[.1em] uppercase my-1.5">{{ $therapist->specialty }}</div>
  <p class="text-[var(--muted)] text-[13px] leading-[1.7] mb-4">{{ $therapist->bio }}</p>
  <button class="btn btn-outline w-full" @click="$dispatch('open-booking', { therapistId: {{ $therapist->id }} })">Book Session</button>
</div>
