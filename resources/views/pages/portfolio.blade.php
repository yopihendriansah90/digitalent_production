@extends('layouts.app')

@section('content')
@php
  use Illuminate\Support\Facades\Storage;

  $portfolioContent = $portfolioContent ?? null;
  $activeLocale = request()->query('lang', app()->getLocale());
  if (! in_array($activeLocale, ['id', 'en'], true)) {
    $activeLocale = 'id';
  }

  $trans = function ($value, ?string $fallback = null) use ($activeLocale) {
    if (is_array($value)) {
      return data_get($value, $activeLocale) ?: data_get($value, 'id') ?: data_get($value, 'en') ?: $fallback;
    }

    return $value ?: $fallback;
  };

  $resolvePublicImage = function (?string $path): string {
    if (empty($path)) {
      return '';
    }

    if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
      return $path;
    }

    if (str_starts_with($path, '/')) {
      return $path;
    }

    if (str_starts_with($path, 'template/')) {
      return asset($path);
    }

    return Storage::url($path);
  };

  $clientLogoItems = $sections['client_logos']->items ?? collect();
  $trainingGalleryItems = $sections['training_gallery']->items ?? collect();

  $heroTitle = $page?->hero_title ?? 'Client showcase and training gallery aligned with the website draft structure.';
  $heroCards = collect([
    ['title' => 'Presentation Use', 'body' => 'Client logos and curated documentation for trust-building presentation.'],
    ['title' => 'Content Structure', 'body' => 'Separated into client showcase and year-based training activity gallery.'],
  ]);
  $clientsKicker = 'Our Clients';
  $galleryHeading = 'Per year training documentation showcases';
  $galleryItems = collect();
  $clientLogos = collect();

  if ($portfolioContent) {
    $heroTitle = $trans($portfolioContent->hero_title, $heroTitle);
    $heroCards = collect($portfolioContent->hero_cards ?? [])->map(fn ($item) => [
      'title' => $trans(data_get($item, 'title')),
      'body' => $trans(data_get($item, 'body')),
    ]);
    $clientsKicker = $trans($portfolioContent->clients_kicker, 'Our Clients');
    $galleryHeading = $trans($portfolioContent->gallery_heading, 'Per year training documentation showcases');

    $clientLogos = collect($portfolioContent->client_logos ?? [])->map(fn ($item) => [
      'name' => data_get($item, 'name'),
      'image' => data_get($item, 'image'),
    ]);

    $galleryItems = collect($portfolioContent->gallery_items ?? [])->map(fn ($item) => [
      'year' => data_get($item, 'year', '2026'),
      'title' => $trans(data_get($item, 'title')),
      'body' => $trans(data_get($item, 'body')),
      'image' => data_get($item, 'image'),
    ]);
  }

  if ($clientLogos->isEmpty()) {
    $clientLogos = $clientLogoItems->map(fn ($item) => [
      'name' => $item->title,
      'image' => data_get($item->extra, 'image_path'),
    ]);
  }

  if ($galleryItems->isEmpty()) {
    $galleryItems = $trainingGalleryItems->map(fn ($item) => [
      'year' => 'Gallery',
      'title' => $item->title,
      'body' => strip_tags((string) $item->description),
      'image' => data_get($item->extra, 'image_path'),
    ]);
  }

  $groupedGalleryItems = $galleryItems
    ->sortByDesc(function (array $item): int {
      $year = (string) ($item['year'] ?? '');
      $numericYear = (int) preg_replace('/\D+/', '', $year);

      return $numericYear > 0 ? $numericYear : 0;
    })
    ->groupBy('year');
  $clientLogoSlidesDesktop = $clientLogos->chunk(16)->values();
  $clientLogoSlidesMobile = $clientLogos->chunk(6)->values();

  $heroBackgroundImage = $portfolioContent?->getFirstMediaUrl('hero_background') ?: ($page?->getFirstMediaUrl('hero_image_1', 'web') ?: $page?->getFirstMediaUrl('hero_image_1'));
  $heroStyle = "background-image: linear-gradient(135deg, rgba(236,248,255,0.96), rgba(255,255,255,0.98) 42%, rgba(127,215,255,0.22) 100%);";

  if (! empty($heroBackgroundImage)) {
    $safeHeroImage = str_replace(['"', "'"], ['%22', '%27'], $heroBackgroundImage);
    $heroStyle = "background-image: linear-gradient(135deg, rgba(236,248,255,0.86), rgba(255,255,255,0.92) 42%, rgba(127,215,255,0.25) 100%), url('{$safeHeroImage}'); background-size: cover; background-position: center; background-repeat: no-repeat;";
  }
@endphp
<style>
      body {
        font-family: "Plus Jakarta Sans", ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        background:
          radial-gradient(circle at top left, rgba(0, 154, 223, 0.12), transparent 24%),
          radial-gradient(circle at top right, rgba(127, 215, 255, 0.18), transparent 30%),
          linear-gradient(180deg, #fafdff 0%, #ffffff 100%);
      }
      .clients-grid {
        display: grid;
        gap: 20px;
        grid-template-columns: repeat(2, minmax(0, 1fr));
      }
      .clients-grid.mobile-grid {
        grid-template-rows: repeat(3, minmax(0, 1fr));
      }
      .clients-desktop-only {
        display: none;
      }
      .clients-mobile-only {
        display: block;
      }
      .clients-carousel {
        display: flex;
        gap: 18px;
        overflow-x: auto;
        scroll-snap-type: x mandatory;
        scroll-behavior: smooth;
        -webkit-overflow-scrolling: touch;
        scrollbar-width: none;
      }
      .clients-carousel::-webkit-scrollbar {
        display: none;
      }
      .clients-slide {
        min-width: 100%;
        scroll-snap-align: start;
      }
      .clients-dots {
        display: flex;
        justify-content: center;
        gap: 10px;
      }
      .clients-dot {
        width: 10px;
        height: 10px;
        border-radius: 999px;
        border: 0;
        background: rgba(9, 70, 138, 0.2);
        transition: transform 180ms ease, background-color 180ms ease;
      }
      .clients-dot.is-active {
        background: #009adf;
        transform: scale(1.15);
      }
      .logo-card,
      .gallery-card-item {
        position: relative;
        overflow: hidden;
        transition: transform 220ms ease, box-shadow 220ms ease, border-color 220ms ease;
      }
      .logo-card::before,
      .gallery-card-item::before {
        content: "";
        position: absolute;
        left: 18px;
        top: 0;
        width: 64px;
        height: 4px;
        border-radius: 999px;
        background: linear-gradient(90deg, #f3a836 0 45%, #009adf 45% 100%);
      }
      .logo-card:hover,
      .gallery-card-item:hover {
        transform: translateY(-4px);
        border-color: rgba(0, 154, 223, 0.24);
        box-shadow: 0 24px 52px rgba(9, 70, 138, 0.12);
      }
      .client-logo-img {
        width: 100%;
        height: 64px;
        object-fit: contain;
      }
      .gallery-track {
        display: flex;
        gap: 18px;
        overflow-x: auto;
        scroll-snap-type: x mandatory;
        scroll-behavior: smooth;
        scrollbar-width: none;
      }
      .gallery-track::-webkit-scrollbar {
        display: none;
      }
      .gallery-card-item {
        flex: 0 0 min(260px, 78vw);
        scroll-snap-align: start;
        border-radius: 24px;
        border: 1px solid rgba(0, 154, 223, 0.14);
        background: rgba(255, 255, 255, 0.92);
      }
      .gallery-thumb {
        width: 100%;
        aspect-ratio: 4 / 3;
        object-fit: cover;
        border-bottom: 1px solid rgba(15, 23, 42, 0.22);
      }
      .gallery-year-chip {
        border: 1px solid rgba(0, 154, 223, 0.24);
        background: rgba(255, 255, 255, 0.92);
        color: #0f2f55;
        padding: 8px 14px;
        border-radius: 999px;
        font-size: 0.82rem;
        font-weight: 700;
        letter-spacing: 0.06em;
        text-transform: uppercase;
        transition: all 180ms ease;
      }
      .gallery-year-chip.is-active {
        background: #009adf;
        border-color: #009adf;
        color: #fff;
      }
      .gallery-year-filters {
        display: flex;
        flex-wrap: nowrap;
        gap: 8px;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        scrollbar-width: none;
        padding-bottom: 4px;
      }
      .gallery-year-filters::-webkit-scrollbar {
        display: none;
      }
      .gallery-year-filters .gallery-year-chip {
        flex: 0 0 auto;
      }
      .gallery-card-body {
        min-height: 94px;
      }
      .gallery-meta-desc-clamp {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
      }
      @media (min-width: 1024px) {
        .clients-desktop-only {
          display: block;
        }
        .clients-mobile-only {
          display: none;
        }
        .clients-grid { grid-template-columns: repeat(4, minmax(0, 1fr)); }
        .gallery-card-item { flex-basis: 260px; }
        .gallery-year-filters {
          flex-wrap: wrap;
          overflow-x: visible;
          padding-bottom: 0;
        }
      }
</style>

<section class="border-b border-sky-100 py-14 lg:py-20" style="{{ $heroStyle }}">
  <div class="mx-auto max-w-7xl px-4">
    <p class="text-sm font-medium text-slate-500"><a href="{{ route('home') }}" class="hover:text-brand-blue">Home</a> / Client / Portfolio</p>
    <h1 class="mt-5 max-w-4xl text-[2.15rem] font-black leading-[1.05] text-brand-blue sm:text-[2.8rem] lg:text-[3.5rem]">{{ $heroTitle }}</h1>
    <div class="mt-8 grid max-w-3xl gap-4 sm:grid-cols-2">
      @foreach ($heroCards as $card)
      <div class="rounded-[24px] border border-brand-blue/15 {{ $loop->first ? 'bg-white/92' : 'bg-brand-sky/90' }} px-5 py-5 shadow-soft">
        <p class="text-xs font-semibold uppercase tracking-[0.18em] text-slate-500">{{ $card['title'] }}</p>
        <p class="text-lg font-black leading-snug mt-4 text-brand-navy">{{ $card['body'] }}</p>
      </div>
      @endforeach
    </div>
  </div>
</section>

<section class="bg-transparent py-14 lg:py-18">
  <div class="mx-auto max-w-7xl px-4">
    <p class="text-sm font-bold uppercase tracking-[0.22em] text-brand-blue">{{ $clientsKicker }}</p>
    <div class="mt-8 rounded-[30px] border border-brand-blue/14 bg-transparent p-4 sm:p-5 lg:p-6">
      <div class="clients-mobile-only">
        <div id="clients-carousel-mobile" class="clients-carousel js-clients-carousel">
          @foreach ($clientLogoSlidesMobile as $slide)
          <div class="clients-slide">
            <div class="clients-grid mobile-grid">
              @foreach ($slide as $logo)
              <article class="logo-card rounded-[22px] border border-brand-blue/14 bg-white p-5">
                @if (!empty($logo['image']))
                  <img class="client-logo-img" src="{{ $resolvePublicImage($logo['image']) }}" alt="{{ $logo['name'] }} logo" loading="lazy" />
                @else
                  <p class="text-center text-sm font-bold text-brand-blue">{{ $logo['name'] }}</p>
                @endif
              </article>
              @endforeach
            </div>
          </div>
          @endforeach
        </div>
        <div id="clients-dots-mobile" class="clients-dots mt-6 js-clients-dots" aria-label="Client logo pagination mobile"></div>
      </div>

      <div class="clients-desktop-only">
        <div id="clients-carousel-desktop" class="clients-carousel js-clients-carousel">
          @foreach ($clientLogoSlidesDesktop as $slide)
          <div class="clients-slide">
            <div class="clients-grid">
              @foreach ($slide as $logo)
              <article class="logo-card rounded-[22px] border border-brand-blue/14 bg-white p-5">
                @if (!empty($logo['image']))
                  <img class="client-logo-img" src="{{ $resolvePublicImage($logo['image']) }}" alt="{{ $logo['name'] }} logo" loading="lazy" />
                @else
                  <p class="text-center text-sm font-bold text-brand-blue">{{ $logo['name'] }}</p>
                @endif
              </article>
              @endforeach
            </div>
          </div>
          @endforeach
        </div>
        <div id="clients-dots-desktop" class="clients-dots mt-6 js-clients-dots" aria-label="Client logo pagination desktop"></div>
      </div>
    </div>
  </div>
</section>

<section class="bg-transparent py-14 lg:py-20">
  <div class="mx-auto max-w-7xl px-4">
    <h2 class="text-3xl font-black text-brand-blue">{{ $galleryHeading }}</h2>
    <div class="mt-5 gallery-year-filters" id="gallery-year-filters">
      <button type="button" class="gallery-year-chip is-active" data-gallery-filter="all">{{ $activeLocale === 'en' ? 'All' : 'Semua' }}</button>
      @foreach ($groupedGalleryItems as $year => $items)
      <button type="button" class="gallery-year-chip" data-gallery-filter="{{ $year }}">{{ $year }}</button>
      @endforeach
    </div>

    @foreach ($groupedGalleryItems as $year => $items)
    <div class="mt-8 gallery-year-section" data-gallery-year="{{ $year }}">
      <h3 class="text-2xl font-bold text-slate-800">{{ $year }}</h3>
      <div class="gallery-track mt-4">
        @foreach ($items as $item)
        <article class="gallery-card-item">
          @if (!empty($item['image']))
            <img class="gallery-thumb" src="{{ $resolvePublicImage($item['image']) }}" alt="{{ $item['title'] }}" loading="lazy" />
          @endif
          <div class="p-3 gallery-card-body">
            <p class="text-[0.95rem] font-bold text-slate-800">{{ $item['title'] }}</p>
            <p class="mt-1 text-sm text-slate-600 gallery-meta-desc-clamp">{{ $item['body'] }}</p>
          </div>
        </article>
        @endforeach
      </div>
    </div>
    @endforeach
  </div>
</section>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const galleryFilterButtons = document.querySelectorAll('[data-gallery-filter]');
    const gallerySections = document.querySelectorAll('[data-gallery-year]');

    galleryFilterButtons.forEach((button) => {
      button.addEventListener('click', () => {
        const targetYear = button.getAttribute('data-gallery-filter');

        galleryFilterButtons.forEach((chip) => {
          chip.classList.toggle('is-active', chip === button);
        });

        gallerySections.forEach((section) => {
          const year = section.getAttribute('data-gallery-year');
          const isVisible = targetYear === 'all' || year === targetYear;
          section.style.display = isVisible ? '' : 'none';
        });
      });
    });

    const clientCarousels = document.querySelectorAll('.js-clients-carousel');
    clientCarousels.forEach((clientsCarousel) => {
      const clientsDots = clientsCarousel.parentElement.querySelector('.js-clients-dots');
      if (!clientsDots) return;

      const slides = Array.from(clientsCarousel.querySelectorAll('.clients-slide'));
      const dotButtons = slides.map((_, index) => {
        const dot = document.createElement('button');
        dot.type = 'button';
        dot.className = 'clients-dot' + (index === 0 ? ' is-active' : '');
        dot.setAttribute('aria-label', 'Go to client slide ' + (index + 1));
        dot.addEventListener('click', () => {
          clientsCarousel.scrollTo({
            left: clientsCarousel.clientWidth * index,
            behavior: 'smooth',
          });
        });
        clientsDots.appendChild(dot);
        return dot;
      });

      const setActiveDot = () => {
        const index = Math.round(clientsCarousel.scrollLeft / Math.max(1, clientsCarousel.clientWidth));
        dotButtons.forEach((dot, i) => dot.classList.toggle('is-active', i === index));
      };

      clientsCarousel.addEventListener('scroll', setActiveDot, { passive: true });

      clientsCarousel.addEventListener('wheel', (event) => {
        if (clientsCarousel.scrollWidth <= clientsCarousel.clientWidth) {
          return;
        }

        const delta = Math.abs(event.deltaY) > Math.abs(event.deltaX) ? event.deltaY : event.deltaX;
        if (delta === 0) {
          return;
        }

        event.preventDefault();
        clientsCarousel.scrollLeft += delta;
      }, { passive: false });

      setActiveDot();
    });

    const desktopMedia = window.matchMedia('(min-width: 1024px)');
    const tracks = document.querySelectorAll('.gallery-track');

    tracks.forEach((track) => {
      let rafId = null;
      let lastTime = 0;
      let isHovering = false;
      let isUserInteracting = false;
      let interactionTimer = null;

      const speedPxPerSecond = 22;

      const stopAutoScroll = () => {
        if (rafId !== null) {
          cancelAnimationFrame(rafId);
          rafId = null;
        }
      };

      const startAutoScroll = () => {
        if (!desktopMedia.matches || rafId !== null) {
          return;
        }

        lastTime = 0;
        const maxScroll = () => track.scrollWidth - track.clientWidth;

        const tick = (time) => {
          if (!desktopMedia.matches) {
            stopAutoScroll();
            return;
          }

          if (lastTime === 0) {
            lastTime = time;
          }

          const dt = (time - lastTime) / 1000;
          lastTime = time;

          if (!isHovering && !isUserInteracting && maxScroll() > 0) {
            track.scrollLeft += speedPxPerSecond * dt;

            if (track.scrollLeft >= maxScroll() - 1) {
              track.scrollLeft = 0;
            }
          }

          rafId = requestAnimationFrame(tick);
        };

        rafId = requestAnimationFrame(tick);
      };

      const markInteracting = () => {
        isUserInteracting = true;
        if (interactionTimer) {
          clearTimeout(interactionTimer);
        }
        interactionTimer = setTimeout(() => {
          isUserInteracting = false;
        }, 900);
      };

      track.addEventListener('mouseenter', () => {
        isHovering = true;
      });

      track.addEventListener('mouseleave', () => {
        isHovering = false;
      });

      track.addEventListener('wheel', (event) => {
        if (!desktopMedia.matches) {
          return;
        }

        const hasHorizontalOverflow = track.scrollWidth > track.clientWidth;
        if (!hasHorizontalOverflow) {
          return;
        }

        event.preventDefault();
        const delta = Math.abs(event.deltaY) > Math.abs(event.deltaX) ? event.deltaY : event.deltaX;
        track.scrollLeft += delta;
        markInteracting();
      }, { passive: false });

      track.addEventListener('scroll', markInteracting, { passive: true });

      const onViewportChange = () => {
        if (desktopMedia.matches) {
          startAutoScroll();
          return;
        }

        stopAutoScroll();
      };

      if (typeof desktopMedia.addEventListener === 'function') {
        desktopMedia.addEventListener('change', onViewportChange);
      } else if (typeof desktopMedia.addListener === 'function') {
        desktopMedia.addListener(onViewportChange);
      }

      onViewportChange();
    });
  });
</script>
@endsection
