@extends('layouts.app')

@section('content')
@php
  use Illuminate\Support\Facades\Storage;

  $trainingContent = $trainingContent ?? null;
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

  $trainingDomainItems = $sections['training_domains']->items ?? collect();

  $heroTitle = $page?->hero_title ?? 'Training catalog structured by domain, learning format, and industry relevance.';
  $heroCards = collect([
    ['title' => 'Coverage', 'body' => 'Seven domain categories from GRC to project management.'],
    ['title' => 'Learning Format', 'body' => 'Catalog-ready programs for structured and industry-relevant learning paths.'],
  ]);

  if ($trainingContent) {
    $heroTitle = $trans($trainingContent->hero_title, $heroTitle);

    $heroCards = collect($trainingContent->hero_cards ?? [])->map(fn ($item) => [
      'title' => $trans(data_get($item, 'title')),
      'body' => $trans(data_get($item, 'body')),
    ]);

    $trainingDomainItems = collect($trainingContent->domains ?? [])->map(fn ($item) => (object) [
      'title' => $trans(data_get($item, 'title')),
      'description' => $trans(data_get($item, 'body')),
      'badge' => $trans(data_get($item, 'badge')),
      'link' => data_get($item, 'link'),
    ]);
  }

  $trainingDomainItems = collect($trainingDomainItems)->sortBy(function ($item): int {
    $title = mb_strtolower(trim((string) ($item->title ?? '')));

    return $title === 'cybersecurity' ? 0 : 1;
  })->values();

  $heroBackgroundMode = $trainingContent?->hero_background_mode ?? 'color';
  $showDomainNumbering = $trainingContent?->show_domain_numbering ?? true;
  $heroBackgroundImage = $trainingContent?->getFirstMediaUrl('hero_background') ?: ($page?->getFirstMediaUrl('hero_image_1', 'web') ?: $page?->getFirstMediaUrl('hero_image_1'));
  $heroStyle = 'background-image: linear-gradient(160deg, #f0a530 0%, #f4b651 46%, #f8cd85 100%);';

  if ($heroBackgroundMode === 'image' && ! empty($heroBackgroundImage)) {
    $safeHeroImage = str_replace(['"', "'"], ['%22', '%27'], $heroBackgroundImage);
    $heroStyle = "background-image: linear-gradient(180deg, rgba(0,0,0,0.52), rgba(0,0,0,0.64)), url('{$safeHeroImage}'); background-size: cover; background-position: center; background-repeat: no-repeat;";
  }
  $homeLabel = 'Home';
  $pageLabel = $activeLocale === 'en' ? 'Training' : 'Pelatihan';
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
      .training-card {
        position: relative;
        overflow: hidden;
        border: 1px solid rgba(0, 154, 223, 0.14);
        background: linear-gradient(180deg, rgba(255, 255, 255, 0.96), rgba(236, 248, 255, 0.82));
        box-shadow: 0 18px 44px rgba(9, 70, 138, 0.08);
        transition: transform 220ms ease, box-shadow 220ms ease, border-color 220ms ease;
      }
      .training-card::before {
        content: "";
        position: absolute;
        left: 22px;
        top: 0;
        width: 74px;
        height: 4px;
        border-radius: 999px;
        background: linear-gradient(90deg, #f3a836 0 45%, #009adf 45% 100%);
      }
      .training-card:hover {
        transform: translateY(-4px);
        border-color: rgba(0, 154, 223, 0.24);
        box-shadow: 0 24px 52px rgba(9, 70, 138, 0.12);
      }
      .training-rich-copy ul {
        margin-left: 1.1rem;
        list-style: disc;
      }
      .training-rich-copy li + li {
        margin-top: 0.3rem;
      }
</style>

<section class="border-b border-brand-orange/30 py-14 lg:py-20" style="{{ $heroStyle }}">
  <div class="mx-auto max-w-7xl px-4">
    <p class="text-sm font-medium text-white/92"><a href="{{ $homeUrl }}" class="hover:text-white">{{ $homeLabel }}</a> / {{ $pageLabel }}</p>
    <h1 class="mt-5 max-w-4xl text-[2.15rem] font-black leading-[1.05] text-white sm:text-[2.8rem] lg:text-[3.5rem]">{{ $heroTitle }}</h1>
    <div class="mt-8 grid max-w-3xl gap-4 sm:grid-cols-2">
      @foreach ($heroCards as $card)
      <div class="rounded-[24px] border border-brand-navy/14 bg-white px-5 py-5 shadow-[0_20px_44px_rgba(9,70,138,0.14)]">
        <p class="text-xs font-semibold uppercase tracking-[0.18em] text-brand-navy/70">{{ $card['title'] }}</p>
        <div class="mt-2 h-[3px] w-14 rounded-full bg-[linear-gradient(90deg,_#f3a836_0_45%,_#009adf_45%_100%)]"></div>
        <p class="mt-4 text-lg font-black leading-snug text-brand-navy">{{ $card['body'] }}</p>
      </div>
      @endforeach
    </div>
  </div>
</section>

<section class="bg-[linear-gradient(180deg,_rgba(255,255,255,0.94),_rgba(236,248,255,0.5))] py-14 lg:py-20">
  <div class="mx-auto max-w-7xl px-4">
    <div class="grid gap-5 md:grid-cols-2 xl:grid-cols-4">
      @forelse ($trainingDomainItems as $index => $item)
        <article class="training-card rounded-[26px] p-6 pt-7">
          @if ($showDomainNumbering)
            <p class="text-sm font-bold uppercase tracking-[0.2em] text-brand-blue">Domain {{ str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) }}</p>
          @endif
          <h2 class="mt-4 text-2xl font-black text-brand-blue">{{ $item->title }}</h2>
          <div class="training-rich-copy leading-7 mt-4 text-slate-600">{!! $item->description !!}</div>
          @if (filled($item->badge) && filled($item->link))
            <a
              href="{{ $item->link }}"
              target="_blank"
              rel="noopener noreferrer"
              class="mt-6 inline-flex items-center rounded-full border border-brand-orange bg-brand-orange px-4 py-2 text-sm font-bold text-white transition hover:border-brand-blue hover:bg-brand-blue hover:text-white"
            >
              <span>{{ $item->badge }}</span>
            </a>
          @endif
        </article>
      @empty
        <article class="training-card rounded-[26px] p-6 pt-7">
          @if ($showDomainNumbering)
            <p class="text-sm font-bold uppercase tracking-[0.2em] text-brand-blue">Domain 01</p>
          @endif
          <h2 class="mt-4 text-2xl font-black text-brand-blue">GRC</h2>
          <p class="leading-7 mt-4 text-slate-600">Governance, Risk, & Compliance programs for security and regulatory readiness.</p>
        </article>
      @endforelse
    </div>
  </div>
</section>
@endsection
