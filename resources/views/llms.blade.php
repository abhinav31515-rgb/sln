# {{ $identity->get('brand_name', 'AURUM') }}

## About
{{ $identity->get('tagline', 'Luxury Unisex Salon & Spa') }}

@if($seo && $seo->llm_summary)
{{ $seo->llm_summary }}
@else
{{ $seo->description ?? 'Premium salon and spa services in ' . $identity->get('city', 'Gurugram') }}
@endif

## Contact
- Location: {{ $identity->get('address', '') }}, {{ $identity->get('city', 'Gurugram') }}
- Phone: {{ $identity->get('phone', '') }}
- Email: {{ $identity->get('email', '') }}

## Services
We offer luxury salon and spa services including haircare, skincare, massage therapy, and wellness treatments.

@if($seo && $seo->llm_keywords)
## Keywords
{{ $seo->llm_keywords }}
@endif

## Social Media
@if($identity->get('social_instagram'))
- Instagram: {{ $identity->get('social_instagram') }}
@endif
@if($identity->get('social_facebook'))
- Facebook: {{ $identity->get('social_facebook') }}
@endif
@if($identity->get('social_twitter'))
- Twitter: {{ $identity->get('social_twitter') }}
@endif

---
This content is optimized for LLM indexing and summarization.
