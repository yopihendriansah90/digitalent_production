@extends('layouts.app')

@section('content')

@php
  $coreValuesBlock = $sections['core_values'] ?? null;
  $coreValuesItems = $coreValuesBlock?->items ?? collect();
  $progressCounterBlock = $sections['progress_counter'] ?? null;
  $progressCounterItems = $sections['progress_counter']->items ?? collect();
  $whyChooseBlock = $sections['why_choose_us'] ?? null;
  $whyChooseItems = $sections['why_choose_us']->items ?? collect();
  $faqBlock = $sections['cta'] ?? null;
  $faqItems = $sections['cta']->items ?? collect();

  $defaultHeroSlides = [
    'https://smb.telkomuniversity.ac.id/wp-content/uploads/2024/08/Kegiatan-Mahasiswa-Selain-Kuliah-Ini-6-Rekomendasinya.jpg',
    'https://smb.telkomuniversity.ac.id/wp-content/uploads/2025/11/YK-17.jpg',
    'https://smb.telkomuniversity.ac.id/wp-content/uploads/2025/11/YK-11.jpg',
  ];

  $heroSlides = collect();

  if ($page) {
    $heroSlides = collect([
      $page->getFirstMediaUrl('hero_image_1', 'web') ?: $page->getFirstMediaUrl('hero_image_1'),
      $page->getFirstMediaUrl('hero_image_2', 'web') ?: $page->getFirstMediaUrl('hero_image_2'),
      $page->getFirstMediaUrl('hero_image_3', 'web') ?: $page->getFirstMediaUrl('hero_image_3'),
    ])
      ->filter()
      ->values();

    if ($heroSlides->isEmpty()) {
      $heroSlides = $page->getMedia('hero_images')
        ->map(fn ($media) => $media->hasGeneratedConversion('web') ? $media->getUrl('web') : $media->getUrl())
        ->filter()
        ->take(3)
        ->values();
    }

    if ($heroSlides->isEmpty()) {
      $heroBackground = $page->getFirstMediaUrl('hero_background', 'web') ?: $page->getFirstMediaUrl('hero_background');

      if (filled($heroBackground)) {
        $heroSlides = collect([$heroBackground]);
      }
    }
  }

  if ($heroSlides->isEmpty()) {
    $heroSlides = collect($defaultHeroSlides);
  }
@endphp
<style>

      html { scroll-behavior: smooth; }
      body {
        font-family: "Plus Jakarta Sans", ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        background:
          radial-gradient(circle at top left, rgba(0, 154, 223, 0.12), transparent 24%),
          radial-gradient(circle at top right, rgba(127, 215, 255, 0.18), transparent 30%),
          linear-gradient(180deg, #fafdff 0%, #ffffff 100%);
      }
      .hero-entrance [data-hero-item] {
        opacity: 0;
        transform: translateY(26px);
        animation: heroRise 760ms cubic-bezier(0.22, 1, 0.36, 1) forwards;
      }
      .hero-entrance [data-hero-item="badges"] { animation-delay: 120ms; }
      .hero-entrance [data-hero-item="title"] { animation-delay: 220ms; }
      .hero-entrance [data-hero-item="cta"] { animation-delay: 340ms; }
      .hero-entrance [data-hero-item="media"] {
        animation-delay: 240ms;
        transform: translateY(26px) scale(0.98);
      }
      @keyframes heroRise {
        from {
          opacity: 0;
          transform: translateY(26px) scale(0.985);
        }
        to {
          opacity: 1;
          transform: translateY(0) scale(1);
        }
      }
      .reveal {
        opacity: 1;
        transform: translateY(0);
        transition: opacity 760ms cubic-bezier(0.22, 1, 0.36, 1), transform 760ms cubic-bezier(0.22, 1, 0.36, 1);
      }
      .reveal.is-visible {
        opacity: 1;
        transform: translateY(0);
      }
      .stagger-group .stagger-item {
        opacity: 1;
        transform: translateY(0);
        transition: opacity 720ms cubic-bezier(0.22, 1, 0.36, 1), transform 720ms cubic-bezier(0.22, 1, 0.36, 1);
      }
      .stagger-group.is-visible .stagger-item {
        opacity: 1;
        transform: translateY(0);
      }
      .stagger-group.is-visible .stagger-item:nth-child(1) { transition-delay: 70ms; }
      .stagger-group.is-visible .stagger-item:nth-child(2) { transition-delay: 130ms; }
      .stagger-group.is-visible .stagger-item:nth-child(3) { transition-delay: 190ms; }
      .stagger-group.is-visible .stagger-item:nth-child(4) { transition-delay: 250ms; }
      .stagger-group.is-visible .stagger-item:nth-child(5) { transition-delay: 310ms; }
      .interactive-card {
        transition: transform 260ms ease, box-shadow 260ms ease, border-color 260ms ease, background-color 260ms ease;
        will-change: transform;
      }
      .interactive-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 30px 70px rgba(9, 70, 138, 0.16);
        border-color: rgba(0, 154, 223, 0.28);
      }
      .cta-button {
        transition: transform 220ms ease, box-shadow 220ms ease, background-color 220ms ease, color 220ms ease, border-color 220ms ease;
      }
      .cta-button:hover {
        transform: translateY(-3px);
      }
      .hero-entrance {
        position: relative;
      }
      .hero-background {
        position: absolute;
        inset: 0;
        z-index: 0;
        overflow: hidden;
      }
      .hero-bg-slide {
        position: absolute;
        inset: 0;
        background-size: cover;
        background-position: center;
        opacity: 0;
        transition: opacity 1000ms ease;
      }
      .hero-bg-slide.is-active {
        opacity: 1;
      }
      .hero-overlay {
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, 0.7);
      }
      .hero-content {
        position: relative;
        z-index: 1;
      }
      @media (min-width: 1024px) {
        .hero-entrance {
          min-height: 56.25vw; /* 16:9 ratio reference (2560x1440 style) */
          max-height: 100vh;
        }
        .hero-content {
          min-height: inherit;
          display: flex;
          align-items: center;
        }
      }
      .hero-photo,
      .gallery-photo {
        background-image: linear-gradient(180deg, rgba(9, 70, 138, 0.08), rgba(9, 70, 138, 0.22)), var(--photo);
        background-size: cover;
        background-position: center;
        transition: transform 420ms ease, filter 420ms ease;
        will-change: transform;
      }
      .hero-photo-primary {
        background-position: center top;
      }
      .hero-photo-secondary-top {
        background-position: center 22%;
      }
      .hero-photo-secondary-bottom {
        background-position: center 32%;
      }
      .hero-stack:hover .hero-photo,
      .gallery-frame:hover .gallery-photo {
        transform: scale(1.03);
        filter: saturate(1.06);
      }
      .hero-panel {
        position: relative;
        overflow: hidden;
      }
      /* Area foto hero memakai kolase 3 slot, bukan satu banner penuh.
         Tujuannya agar visual terasa lebih hidup dan memberi cerita:
         1) foto besar kiri = bukti utama aktivitas inti DigiTalent,
         2) foto kanan atas = interaksi, energi, atau engagement peserta,
         3) foto kanan bawah = skala event, kelas formal, atau kredibilitas delivery.
         Komposisi ini tetap konsisten antara desktop dan mobile karena urutan slot
         tidak berubah; yang berubah hanya tinggi dan kepadatan layout agar tetap nyaman
         dibaca di layar kecil. */
      .hero-panel::before {
        content: "";
        position: absolute;
        inset: 18px;
        border-radius: 28px;
        background:
          radial-gradient(circle at top left, rgba(127, 215, 255, 0.24), transparent 38%),
          radial-gradient(circle at bottom right, rgba(0, 154, 223, 0.16), transparent 40%),
          linear-gradient(135deg, rgba(9, 70, 138, 0.05), rgba(0, 154, 223, 0.08));
        pointer-events: none;
      }
      .hero-photo-card {
        position: relative;
        overflow: hidden;
        border: 1px solid rgba(148, 163, 184, 0.18);
        background: #fff;
      }
      .hero-photo-meta {
        position: absolute;
        left: 16px;
        right: 16px;
        bottom: 16px;
        border-radius: 18px;
        background: linear-gradient(135deg, rgba(9, 70, 138, 0.88), rgba(0, 154, 223, 0.74));
        color: #fff;
        padding: 14px 16px;
        backdrop-filter: blur(10px);
      }
      .hero-stat-chip {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        border-radius: 999px;
        background: linear-gradient(180deg, rgba(255, 255, 255, 0.95), rgba(255, 248, 239, 0.95));
        padding: 10px 14px;
        box-shadow: 0 18px 40px rgba(9, 70, 138, 0.16);
      }
      .hero-stat-chip::before {
        content: "";
        width: 10px;
        height: 10px;
        border-radius: 999px;
        background: #f3a836;
        flex: 0 0 auto;
      }
      .hero-proof-grid {
        display: grid;
        gap: 12px;
        grid-template-columns: minmax(0, 1fr);
      }
      .hero-proof-item {
        position: relative;
        overflow: hidden;
        border-radius: 20px;
        border: 1px solid rgba(255, 255, 255, 0.24);
        background:
          linear-gradient(180deg, rgba(7, 16, 31, 0.5), rgba(7, 16, 31, 0.34)),
          linear-gradient(120deg, rgba(255, 255, 255, 0.08), rgba(255, 255, 255, 0.02));
        padding: 18px 18px 16px;
        backdrop-filter: blur(10px);
        transition: transform 220ms ease, border-color 220ms ease, background-color 220ms ease;
      }
      .hero-proof-item::before {
        content: "";
        position: absolute;
        left: 16px;
        top: 0;
        width: 74px;
        height: 3px;
        border-radius: 999px;
        background: linear-gradient(90deg, #f3a836 0 46%, #009adf 46% 100%);
      }
      .hero-proof-item:hover {
        transform: translateY(-2px);
        border-color: rgba(255, 255, 255, 0.42);
        background:
          linear-gradient(180deg, rgba(7, 16, 31, 0.58), rgba(7, 16, 31, 0.4)),
          linear-gradient(120deg, rgba(255, 255, 255, 0.08), rgba(255, 255, 255, 0.03));
      }
      .hero-proof-label {
        color: #6b7a90;
      }
      .hero-proof-value {
        color: #09468a;
      }
      .stats-card {
        border: 1px solid rgba(255, 255, 255, 0.18);
        background:
          linear-gradient(180deg, rgba(255, 255, 255, 0.12), rgba(255, 255, 255, 0.06)),
          linear-gradient(135deg, rgba(0, 154, 223, 0.16), rgba(127, 215, 255, 0.1));
        box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.05);
        transition: transform 240ms ease, border-color 240ms ease, background-color 240ms ease, box-shadow 240ms ease;
      }
      .stats-card:hover {
        transform: translateY(-4px);
        border-color: rgba(127, 215, 255, 0.34);
        background: linear-gradient(180deg, rgba(255, 255, 255, 0.11), rgba(255, 255, 255, 0.07));
        box-shadow: 0 22px 40px rgba(3, 24, 51, 0.18);
      }
      .stats-kicker {
        color: rgba(255, 255, 255, 0.66);
      }
      .stats-copy {
        color: rgba(255, 255, 255, 0.94);
      }
      .values-grid {
        display: grid;
        gap: 20px;
      }
      .value-card {
        text-align: center;
        position: relative;
        min-height: 100%;
        border: 1px solid rgba(0, 154, 223, 0.14);
        background:
          radial-gradient(circle at top right, rgba(127, 215, 255, 0.22), transparent 38%),
          linear-gradient(180deg, #ffffff, #f4fbff);
        box-shadow: 0 16px 38px rgba(9, 70, 138, 0.08);
        transition: transform 240ms ease, box-shadow 240ms ease, border-color 240ms ease;
      }
      .value-card::before {
        content: "";
        position: absolute;
        left: 24px;
        top: 0;
        width: 58px;
        height: 4px;
        border-radius: 999px;
        background: linear-gradient(90deg, #f3a836, #009adf);
      }
      .value-card:hover {
        transform: translateY(-4px);
        border-color: rgba(0, 154, 223, 0.24);
        box-shadow: 0 24px 52px rgba(9, 70, 138, 0.12);
      }
      .value-index {
        color: #f3a836;
      }
      .value-meta {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
      }
      .value-icon {
        width: 100px;
        height: 100px;
        object-fit: contain;
      }
      .value-copy {
        color: #4b5b74;
      }
      .why-grid {
        display: grid;
        gap: 20px;
      }
      .why-card {
        position: relative;
        min-height: 100%;
        border: 1px solid rgba(0, 154, 223, 0.16);
        background:
          radial-gradient(circle at top left, rgba(127, 215, 255, 0.22), transparent 32%),
          linear-gradient(180deg, #ffffff, #f3fbff);
        box-shadow: 0 16px 38px rgba(9, 70, 138, 0.08);
        transition: transform 240ms ease, box-shadow 240ms ease, border-color 240ms ease;
      }
      .why-card::before {
        content: "";
        position: absolute;
        left: 24px;
        top: 0;
        width: 58px;
        height: 4px;
        border-radius: 999px;
        background: linear-gradient(90deg, #f3a836, #009adf);
      }
      .why-card:hover {
        transform: translateY(-4px);
        border-color: rgba(0, 154, 223, 0.24);
        box-shadow: 0 24px 52px rgba(9, 70, 138, 0.12);
      }
      .why-copy {
        color: #51627c;
      }
      .faq-item summary {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
      }
      .faq-item summary::-webkit-details-marker {
        display: none;
      }
      .faq-item summary::after {
        content: "+";
        font-size: 1.4rem;
        line-height: 1;
        color: #009adf;
        transition: transform 280ms ease, color 220ms ease;
      }
      .faq-item[open] summary::after {
        transform: rotate(45deg);
        color: #09468a;
      }
      .faq-answer {
        display: grid;
        grid-template-rows: 0fr;
        opacity: 0;
        transition: grid-template-rows 340ms ease, opacity 280ms ease;
      }
      .faq-answer > div {
        overflow: hidden;
      }
      .faq-item[open] .faq-answer {
        grid-template-rows: 1fr;
        opacity: 1;
      }
      .section-shell {
        position: relative;
        overflow: hidden;
      }
      .section-shell::before {
        content: "";
        position: absolute;
        inset: 0;
        pointer-events: none;
        background:
          radial-gradient(circle at 12% 16%, rgba(127, 215, 255, 0.18), transparent 18%),
          radial-gradient(circle at 88% 22%, rgba(0, 154, 223, 0.12), transparent 22%);
      }
      @media (min-width: 1280px) {
        .values-grid {
          grid-template-columns: repeat(6, minmax(0, 1fr));
        }
        .values-grid .value-card:nth-child(-n+3) {
          grid-column: span 2 / span 2;
        }
        .values-grid .value-card:nth-child(4) {
          grid-column: 2 / span 2;
        }
        .values-grid .value-card:nth-child(5) {
          grid-column: 4 / span 2;
        }
        .why-grid {
          grid-template-columns: repeat(6, minmax(0, 1fr));
        }
        .why-grid .why-card:nth-child(-n+3) {
          grid-column: span 2 / span 2;
        }
        .why-grid .why-card:nth-child(4) {
          grid-column: 2 / span 2;
        }
        .why-grid .why-card:nth-child(5) {
          grid-column: 4 / span 2;
        }
      }
      @media (min-width: 640px) {
        .hero-proof-grid {
          grid-template-columns: repeat(2, minmax(0, 1fr));
        }
      }
      @media (prefers-reduced-motion: reduce) {
        html { scroll-behavior: auto; }
        .hero-entrance [data-hero-item],
        .reveal,
        .stagger-group .stagger-item,
        .interactive-card,
        .value-card,
        .why-card,
        .stats-card,
        .cta-button,
        .hero-photo,
        .gallery-photo {
          opacity: 1 !important;
          transform: none !important;
          transition: none !important;
          animation: none !important;
        }
      }
    
</style>


      <section class="hero-entrance overflow-hidden border-b border-sky-100">
        <div class="hero-background" aria-hidden="true">
          @foreach ($heroSlides as $index => $slideUrl)
            <div class="hero-bg-slide {{ $index === 0 ? 'is-active' : '' }}" style="background-image: url('{{ $slideUrl }}')"></div>
          @endforeach
          <div class="hero-overlay"></div>
        </div>
        <div class="hero-content mx-auto max-w-7xl px-4 py-10 sm:py-14 lg:py-24">
          <div>
            <h1 class="max-w-4xl text-[2.25rem] font-black leading-[1.02] text-white sm:text-[2.9rem] lg:text-[4.1rem]" data-hero-item="title">{{ $page?->hero_title ?? 'Empowering Digital Talent, Enabling Global Success' }}</h1>
            <div class="mt-8 flex flex-col gap-3 sm:flex-row" data-hero-item="cta">
              <a class="cta-button rounded-full bg-brand-blue px-6 py-3.5 text-center font-bold text-white shadow-soft hover:bg-brand-navy hover:text-white" href="{{ route('services') }}">Explore Services</a>
              <a class="cta-button rounded-full border border-white/60 bg-white/20 px-6 py-3.5 text-center font-bold text-white hover:bg-white hover:text-brand-blue" href="{{ route('contact') }}">Free Consultation</a>
            </div>
            <div class="hero-proof-grid mt-8 max-w-2xl" data-hero-item="cta">
              <div class="hero-proof-item">
                <p class="text-[0.72rem] font-semibold uppercase tracking-[0.22em] text-white/70">Core Services</p>
                <p class=" text-[1.4rem] font-black leading-tight text-white sm:text-[1.5rem]mt-4">IT Training & IT Outsourcing</p>
              </div>
              <div class="hero-proof-item">
                <p class="text-[0.72rem] font-semibold uppercase tracking-[0.22em] text-white/70">Operating Standard</p>
                <p class=" text-[1.4rem] font-black leading-tight text-white sm:text-[1.5rem]mt-4">Integrity, Professionalism, Quality</p>
              </div>
            </div>
          </div>

        </div>
      </section>

      <script>
        document.addEventListener('DOMContentLoaded', function () {
          const slides = Array.from(document.querySelectorAll('.hero-bg-slide'));

          if (slides.length <= 1) {
            return;
          }

          let active = 0;

          setInterval(() => {
            slides[active].classList.remove('is-active');
            active = (active + 1) % slides.length;
            slides[active].classList.add('is-active');
          }, 5000);
        });
      </script>

      <section class="section-shell reveal bg-[linear-gradient(180deg,_rgba(255,255,255,0.94),_rgba(236,248,255,0.55))] py-14 sm:py-16 lg:py-20">
        <div class="mx-auto max-w-7xl px-4">
          <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
            <div>
              <p class="text-sm font-bold uppercase tracking-[0.22em] text-brand-blue">Core Values</p>
              <h2 class="mt-[30px] text-3xl font-black text-brand-blue lg:text-[2.7rem]">{{ $coreValuesBlock?->section_title ?: 'The values shaping how DigiTalent works.' }}</h2>
            </div>
          </div>

          <div class="values-grid stagger-group mt-8">
            @forelse ($coreValuesItems as $item)
              @php
                $iconPath = data_get($item->extra, 'icon_path');
                $iconUrl = filled($iconPath) ? \Illuminate\Support\Facades\Storage::disk('public')->url($iconPath) : null;
              @endphp
              <article class="value-card stagger-item rounded-[26px] p-6 sm:p-7">
                @if (filled($iconUrl))
                  <div class="value-meta mb-4">
                    <img src="{{ $iconUrl }}" alt="{{ $item->title }} icon" class="value-icon" loading="lazy" />
                  </div>
                @endif
                <h3 class="mt-1 text-[1.65rem] font-black leading-tight text-brand-blue">{{ $item->title }}</h3>
                <div class="value-copy mt-4 text-lg leading-8 text-slate-700 [&_p]:mb-3 [&_ul]:ml-5 [&_ul]:list-disc [&_ol]:ml-5 [&_ol]:list-decimal">{!! $item->description !!}</div>
              </article>
            @empty
              <article class="value-card stagger-item rounded-[26px] p-6 sm:p-7">
                <h3 class="mt-1 text-[1.65rem] font-black leading-tight text-brand-blue">Integrity</h3>
                <p class="value-copy mt-4 text-lg leading-8">Upholding honesty, responsibility, and professional ethics.</p>
              </article>
            @endforelse
          </div>
        </div>
      </section>

      <section class="reveal bg-[linear-gradient(135deg,_#09468a,_#0b6ebd_52%,_#009adf_100%)] py-14 text-white sm:py-16 lg:py-20">
        <div class="mx-auto max-w-7xl px-4">
          <div class="flex flex-col gap-3 lg:flex-row lg:items-end lg:justify-between">
            <div>
              <p class="text-sm font-bold uppercase tracking-[0.22em] text-brand-orange">{{ $progressCounterBlock?->section_title ?: 'Progress Counter' }}</p>
            </div>
          </div>
          <div class="stagger-group mt-6 grid gap-5 sm:grid-cols-2 xl:grid-cols-4">
            @forelse ($progressCounterItems as $item)
              @php
                $counterLabel = trim(strip_tags((string) $item->description));
                $counterNumber = (int) data_get($item->extra, 'counter', 0);
                $counterSuffix = (string) data_get($item->extra, 'suffix', '+');
              @endphp
              <article class="stats-card stagger-item rounded-[26px] p-6">
                <p class="stats-kicker text-xs font-semibold uppercase tracking-[0.18em]">{{ $counterLabel }}</p>
                <p class="mt-4 text-4xl font-black text-brand-cyan" data-counter="{{ $counterNumber }}" data-suffix="{{ $counterSuffix }}">0{{ $counterSuffix }}</p>
                <p class="stats-copy mt-3 text-lg font-bold">{{ $item->title }}</p>
              </article>
            @empty
              <article class="stats-card stagger-item rounded-[26px] p-6">
                <p class="stats-kicker text-xs font-semibold uppercase tracking-[0.18em]">Training</p>
                <p class="mt-4 text-4xl font-black text-brand-cyan" data-counter="500" data-suffix="+">0+</p>
                <p class="stats-copy mt-3 text-lg font-bold">Completed Training Participants</p>
              </article>
            @endforelse
          </div>
        </div>
      </section>

      <section class="section-shell reveal bg-[linear-gradient(180deg,_rgba(255,255,255,0.96),_rgba(236,248,255,0.5))] py-14 sm:py-16 lg:py-20">
        <div class="mx-auto max-w-7xl px-4">
          <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
            <div>
              <p class="text-sm font-bold uppercase tracking-[0.22em] text-brand-blue">Why Choose Us</p>
              <h2 class="mt-[30px] text-3xl font-black text-brand-blue lg:text-[2.7rem]">{{ $whyChooseBlock?->section_title ?: 'A practical partner for talent development and digital execution.' }}</h2>
            </div>
          </div>

          <div class="why-grid stagger-group mt-8">
            @forelse ($whyChooseItems as $item)
              <article class="why-card stagger-item rounded-[26px] p-6 sm:p-7">
                <h3 class="text-[1.5rem] font-black leading-tight text-brand-blue">{{ $item->title }}</h3>
                <div class="why-copy mt-4 text-lg leading-8 text-slate-700 [&_p]:mb-3 [&_ul]:ml-5 [&_ul]:list-disc [&_ol]:ml-5 [&_ol]:list-decimal">{!! $item->description !!}</div>
              </article>
            @empty
              <article class="why-card stagger-item rounded-[26px] p-6 sm:p-7">
                <h3 class="text-[1.5rem] font-black leading-tight text-brand-blue">Affiliate with SGI Asia as an Authorized CompTIA Partner</h3>
                <p class="why-copy mt-4 text-lg leading-8">Our curriculum and services align with global standards and remain relevant through current case studies, evolving cyber risks, and real industry needs.</p>
              </article>
              <article class="why-card stagger-item rounded-[26px] p-6 sm:p-7">
                <h3 class="text-[1.5rem] font-black leading-tight text-brand-blue">Experienced Professionals</h3>
                <p class="why-copy mt-4 text-lg leading-8">DigiTalent is supported by certified experts and practitioners with proven hands-on project experience across real working environments.</p>
              </article>
              <article class="why-card stagger-item rounded-[26px] p-6 sm:p-7">
                <h3 class="text-[1.5rem] font-black leading-tight text-brand-blue">Backed by a Robust Ecosystem</h3>
                <p class="why-copy mt-4 text-lg leading-8">Through the SGI Asia ecosystem, we gain access to wider client networks and stronger insights into Indonesia's specific IT landscape and requirements.</p>
              </article>
              <article class="why-card stagger-item rounded-[26px] p-6 sm:p-7">
                <h3 class="text-[1.5rem] font-black leading-tight text-brand-blue">Solution-Oriented Approach & Career Support</h3>
                <p class="why-copy mt-4 text-lg leading-8">We combine practical training, recruitment support, and career development so participants are ready to solve actual IT challenges effectively.</p>
              </article>
              <article class="why-card stagger-item rounded-[26px] p-6 sm:p-7">
                <h3 class="text-[1.5rem] font-black leading-tight text-brand-blue">Unwavering Commitment to Quality</h3>
                <p class="why-copy mt-4 text-lg leading-8">Every service is delivered with a strong focus on excellence, professionalism, and measurable satisfaction for our partners and clients.</p>
              </article>
            @endforelse
          </div>
        </div>
      </section>

      <section class="reveal bg-[linear-gradient(180deg,_rgba(236,248,255,0.92),_rgba(255,255,255,0.98))] py-14 sm:py-16 lg:py-20">
        <div class="mx-auto max-w-7xl px-4">
          <div class="mx-auto max-w-5xl">
            <p class="text-sm font-bold uppercase tracking-[0.22em] text-brand-blue">FAQ</p>
            <h2 class="mt-[30px] text-3xl font-black text-brand-blue lg:text-[2.7rem]">{{ $faqBlock?->section_title ?: 'Pertanyaan yang sering ditanyakan' }}</h2>
            <div class="stagger-group mt-8 space-y-4">
              @forelse ($faqItems as $item)
                <details class="faq-item interactive-card stagger-item rounded-[22px] border border-brand-blue/15 bg-white/92 p-5 shadow-soft">
                  <summary class="cursor-pointer list-none text-lg font-bold text-brand-blue">{{ $item->title }}</summary>
                  <div class="faq-answer">
                    <div>
                      <div class="leading-7 mt-4 text-slate-600 cms-richtext">{!! $item->description !!}</div>
                    </div>
                  </div>
                </details>
              @empty
                <details class="faq-item interactive-card stagger-item rounded-[22px] border border-brand-blue/15 bg-white/92 p-5 shadow-soft">
                  <summary class="cursor-pointer list-none text-lg font-bold text-brand-blue">Mengapa training di DigiTalent?</summary>
                  <div class="faq-answer">
                    <div>
                      <p class="leading-7 mt-4 text-slate-600">Program kami disusun praktis, relevan dengan kebutuhan industri, dan didukung trainer berpengalaman serta studi kasus nyata.</p>
                    </div>
                  </div>
                </details>
              @endforelse
            </div>
          </div>
        </div>
      </section>
    
@endsection
