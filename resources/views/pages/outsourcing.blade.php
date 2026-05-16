@extends('layouts.app')

@section('content')
@php
  use Illuminate\Support\Facades\Storage;

  $outsourcingContent = $outsourcingContent ?? null;
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

  $talentProfileItems = $sections['talent_profiles']->items ?? collect();
  $benefitCardItems = $sections['benefit_cards']->items ?? collect();

  $heroTitle = $page?->hero_title ?? 'Top-tier IT experts for short-term and long-term business engagements.';
  $heroCards = collect([
    ['title' => 'Talent Scope', 'body' => 'Dedicated staff, managed services, and project-based IT teams.'],
    ['title' => 'Engagement Model', 'body' => 'Flexible support for operational continuity and business delivery needs.'],
  ]);

  $selectionKicker = 'Professional Selection Process';
  $selectionTitle = 'Lower hiring risk with structured validation and deployment-ready talent.';
  $offerCards = collect();
  $benefitItems = collect();

  if ($outsourcingContent) {
    $heroTitle = $trans($outsourcingContent->hero_title, $heroTitle);
    $heroCards = collect($outsourcingContent->hero_cards ?? [])->map(fn ($item) => [
      'title' => $trans(data_get($item, 'title')),
      'body' => $trans(data_get($item, 'body')),
    ]);

    $offerCards = collect($outsourcingContent->offer_cards ?? [])->map(fn ($item) => [
      'title' => $trans(data_get($item, 'title')),
      'body' => $trans(data_get($item, 'body')),
      'icon' => data_get($item, 'icon'),
    ]);

    $selectionKicker = $trans($outsourcingContent->selection_kicker, $selectionKicker);
    $selectionTitle = $trans($outsourcingContent->selection_title, $selectionTitle);

    $benefitItems = collect($outsourcingContent->benefit_items ?? [])->map(fn ($item) => [
      'body' => $trans(data_get($item, 'body')),
      'icon' => data_get($item, 'icon'),
    ]);
  }

  if ($offerCards->isEmpty()) {
    $offerCards = $talentProfileItems->map(fn ($item) => [
      'title' => $item->title,
      'body' => (string) $item->description,
      'icon' => data_get($item->extra, 'image_path'),
    ]);
  }

  if ($benefitItems->isEmpty()) {
    $benefitItems = $benefitCardItems->map(fn ($item) => [
      'body' => trim(strip_tags((string) ($item->description ?: $item->title))),
      'icon' => null,
    ]);
  }

  $heroBackgroundMode = $outsourcingContent?->hero_background_mode ?? 'color';
  $heroBackgroundImage = $outsourcingContent?->getFirstMediaUrl('hero_background') ?: ($page?->getFirstMediaUrl('hero_image_1', 'web') ?: $page?->getFirstMediaUrl('hero_image_1'));
  $heroStyle = 'background-image: linear-gradient(135deg, #09468a, #0b6ebd 52%, #009adf 100%);';

  if ($heroBackgroundMode === 'image' && ! empty($heroBackgroundImage)) {
    $safeHeroImage = str_replace(['"', "'"], ['%22', '%27'], $heroBackgroundImage);
    $heroStyle = "background-image: linear-gradient(180deg, rgba(0,0,0,0.52), rgba(0,0,0,0.64)), url('{$safeHeroImage}'); background-size: cover; background-position: center; background-repeat: no-repeat;";
  }
  $homeLabel = 'Home';
  $pageLabel = $activeLocale === 'en' ? 'Outsourcing' : 'Alih Daya';
  $homeUrl = route('home', ['lang' => $activeLocale]);
@endphp
<style>
      body {
        font-family: "Plus Jakarta Sans", ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        background:
          radial-gradient(circle at top left, rgba(0, 154, 223, 0.12), transparent 24%),
          radial-gradient(circle at top right, rgba(127, 215, 255, 0.18), transparent 30%),
          linear-gradient(180deg, #fafdff 0%, #ffffff 100%);
      }
      .outsourcing-card,
      .benefit-card {
        position: relative;
        overflow: hidden;
        border: 1px solid rgba(0, 154, 223, 0.14);
        background: linear-gradient(180deg, rgba(255, 255, 255, 0.96), rgba(236, 248, 255, 0.82));
        box-shadow: 0 18px 44px rgba(9, 70, 138, 0.08);
        transition: transform 220ms ease, box-shadow 220ms ease, border-color 220ms ease;
      }
      .outsourcing-card::before,
      .benefit-card::before {
        content: "";
        position: absolute;
        left: 22px;
        top: 0;
        width: 74px;
        height: 4px;
        border-radius: 999px;
        background: linear-gradient(90deg, #f3a836 0 45%, #009adf 45% 100%);
      }
      .outsourcing-card:hover,
      .benefit-card:hover {
        transform: translateY(-4px);
        border-color: rgba(0, 154, 223, 0.24);
        box-shadow: 0 24px 52px rgba(9, 70, 138, 0.12);
      }
      .outsourcing-icon {
        width: 100px;
        height: 100px;
        object-fit: contain;
      }
      .benefit-item {
        display: flex;
        align-items: flex-start;
        gap: 12px;
      }
      .benefit-check {
        width: 24px;
        height: 24px;
        object-fit: contain;
        flex: 0 0 auto;
        margin-top: 2px;
      }
</style>

<section class="py-14 text-white lg:py-20" style="{{ $heroStyle }}">
  <div class="mx-auto max-w-7xl px-4">
    <p class="text-sm font-medium text-white/70"><a href="{{ $homeUrl }}" class="hover:text-white">{{ $homeLabel }}</a> / {{ $pageLabel }}</p>
    <h1 class="mt-5 max-w-4xl text-[2.15rem] font-black leading-[1.05] sm:text-[2.8rem] lg:text-[3.5rem]">{{ $heroTitle }}</h1>
    <div class="mt-8 grid max-w-3xl gap-4 sm:grid-cols-2">
      @foreach ($heroCards as $card)
      <div class="rounded-[24px] border border-white/15 bg-white/10 px-5 py-5 backdrop-blur-sm">
        <p class="text-xs font-semibold uppercase tracking-[0.18em] text-white/70">{{ $card['title'] }}</p>
        <p class="text-lg font-black leading-snug mt-4 text-white">{{ $card['body'] }}</p>
      </div>
      @endforeach
    </div>
  </div>
</section>

<section class="bg-[linear-gradient(180deg,_rgba(255,255,255,0.94),_rgba(236,248,255,0.5))] py-14 lg:py-20">
  <div class="mx-auto max-w-7xl px-4">
    <div class="grid gap-5 md:grid-cols-2 xl:grid-cols-4">
      @forelse ($offerCards as $item)
        <article class="outsourcing-card rounded-[26px] p-6 pt-7">
          @if (!empty($item['icon']))
            <img class="outsourcing-icon" src="{{ $resolvePublicImage($item['icon']) }}" alt="{{ $item['title'] }} icon" />
          @endif
          <h2 class="text-2xl font-black text-brand-blue">{{ $item['title'] }}</h2>
          <div class="leading-7 mt-4 text-slate-600 [&_p]:mb-3 [&_ul]:ml-5 [&_ul]:list-disc [&_ol]:ml-5 [&_ol]:list-decimal">{!! $item['body'] !!}</div>
        </article>
      @empty
        <article class="outsourcing-card rounded-[26px] p-6 pt-7">
          <h2 class="text-2xl font-black text-brand-blue">Dedicated IT Staff</h2>
          <p class="leading-7 mt-4 text-slate-600">Programmers, Network Engineers, Data Analysts, and other deployment-ready professionals.</p>
        </article>
      @endforelse
    </div>
  </div>
</section>

<section class="bg-[linear-gradient(180deg,_rgba(236,248,255,0.92),_rgba(255,255,255,0.98))] py-14 lg:py-20">
  <div class="mx-auto max-w-7xl px-4">
    <div class="grid gap-6 lg:grid-cols-[0.9fr_1.1fr]">
      <div>
        <p class="text-sm font-bold uppercase tracking-[0.22em] text-brand-blue">{{ $selectionKicker }}</p>
        <h2 class="mt-4 text-3xl font-black text-brand-blue">{{ $selectionTitle }}</h2>
      </div>
      <div class="grid gap-4 sm:grid-cols-2">
        @forelse ($benefitItems as $item)
          <div class="benefit-card rounded-[24px] p-5 pt-7">
            <div class="benefit-item">
              <img class="benefit-check" src="{{ !empty($item['icon']) ? $resolvePublicImage($item['icon']) : asset('template/Logo/assets/check.png') }}" alt="Check icon" />
              <div class="text-slate-700 [&_p]:mb-2 [&_ul]:ml-5 [&_ul]:list-disc [&_ol]:ml-5 [&_ol]:list-decimal">{!! $item['body'] !!}</div>
            </div>
          </div>
        @empty
          <div class="benefit-card rounded-[24px] p-5 pt-7">
            <div class="benefit-item">
              <p>Pre-qualified talent with verified experience and certifications.</p>
            </div>
          </div>
        @endforelse
      </div>
    </div>
  </div>
</section>
@endsection
