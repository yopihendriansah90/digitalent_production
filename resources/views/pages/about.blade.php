@extends('layouts.app')

@section('content')
@php
  $aboutContent = $aboutContent ?? null;
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

  $snapshotItems = ($sections['snapshot']->items ?? collect())->keyBy(fn ($item) => strtolower((string) $item->badge));
  $snapshotFounded = $snapshotItems->get('founded');
  $snapshotGroup = $snapshotItems->get('group');
  $snapshotFocusOne = $snapshotItems->get('focus_1');
  $snapshotFocusTwo = $snapshotItems->get('focus_2');
  $whoWeAreTitle = $trans($aboutContent?->who_we_are_title, $sections['who_we_are']->section_title ?? 'Who We Are');
  $whereWeComeFromTitle = $trans($aboutContent?->where_we_come_from_title, $sections['where_we_come_from']->section_title ?? 'Where We Come From');
  $commitmentTitle = $trans($aboutContent?->commitment_title, $sections['commitment']->section_title ?? 'Our Commitment');
  $snapshotSectionTitle = $trans($aboutContent?->business_focus_title, $sections['snapshot']->section_title ?? 'Business Focus');
  $aboutPhotoUrl = $aboutContent?->getFirstMediaUrl('about_photo') ?: ($page?->getFirstMediaUrl('about_photo', 'web') ?: asset('template/Logo/about.jpeg'));
  $aboutHeroBgUrl = $aboutContent?->getFirstMediaUrl('hero_background');
  $heroSectionStyle = $aboutHeroBgUrl
    ? "background-image: linear-gradient(180deg, rgba(0,0,0,0.52), rgba(0,0,0,0.64)), url('{$aboutHeroBgUrl}'); background-size: cover; background-position: center;"
    : 'background-image: linear-gradient(135deg, rgba(236,248,255,0.96), rgba(255,255,255,0.98) 42%, rgba(127,215,255,0.22) 100%); background-size: cover; background-position: center;';
  $heroTitle = $trans($aboutContent?->hero_title, $page?->hero_title ?? 'Strategic partner for digital transformation through IT Training and IT Outsourcing.');
  $whoWeAreBody = $trans($aboutContent?->who_we_are_body, $sections['who_we_are']->section_description ?? null);
  $whereWeComeFromBody = $trans($aboutContent?->where_we_come_from_body, $sections['where_we_come_from']->section_description ?? null);
  $commitmentBody = $trans($aboutContent?->commitment_body, $sections['commitment']->section_description ?? null);
  $foundedLabel = $trans($aboutContent?->founded_label, $snapshotFounded?->title ?? 'Founded');
  $foundedValue = $trans($aboutContent?->founded_value, $snapshotFounded?->description ?? 'Aug 2025');
  $groupLabel = $trans($aboutContent?->group_label, $snapshotGroup?->title ?? 'Group');
  $groupValue = $trans($aboutContent?->group_value, $snapshotGroup?->description ?? 'SGI Asia');
  $focus1Title = $trans($aboutContent?->focus_1_title, $snapshotFocusOne?->title ?? 'IT Training');
  $focus1Body = $trans($aboutContent?->focus_1_body, $snapshotFocusOne?->description ?? 'Structured learning, mentoring, certification preparation, and applied capability development.');
  $focus2Title = $trans($aboutContent?->focus_2_title, $snapshotFocusTwo?->title ?? 'IT Outsourcing');
  $focus2Body = $trans($aboutContent?->focus_2_body, $snapshotFocusTwo?->description ?? 'Trusted IT talent supply for project, operational, and long-term business needs.');
  $homeLabel = 'Home';
  $pageLabel = $activeLocale === 'en' ? 'About Us' : 'Tentang Kami';
  $homeUrl = route('home', ['lang' => $activeLocale]);
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
      .reveal {
        opacity: 0;
        transform: translateY(24px);
        transition: opacity 700ms ease, transform 700ms ease;
      }
      .reveal.is-visible {
        opacity: 1;
        transform: translateY(0);
      }
      .story-photo {
        background-image: linear-gradient(180deg, rgba(9, 70, 138, 0.08), rgba(9, 70, 138, 0.2)), var(--photo);
        background-position: center;
        background-size: cover;
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
      .panel-card {
        position: relative;
        overflow: hidden;
        border: 1px solid rgba(0, 154, 223, 0.14);
        background: linear-gradient(180deg, rgba(255, 255, 255, 0.96), rgba(236, 248, 255, 0.82));
        box-shadow: 0 18px 44px rgba(9, 70, 138, 0.08);
        transition: transform 220ms ease, box-shadow 220ms ease, border-color 220ms ease;
      }
      .panel-card::before {
        content: "";
        position: absolute;
        left: 22px;
        top: 0;
        width: 74px;
        height: 4px;
        border-radius: 999px;
        background: linear-gradient(90deg, #f3a836 0 45%, #009adf 45% 100%);
      }
      .panel-card:hover {
        transform: translateY(-4px);
        border-color: rgba(0, 154, 223, 0.24);
        box-shadow: 0 24px 52px rgba(9, 70, 138, 0.12);
      }
      @media (prefers-reduced-motion: reduce) {
        html { scroll-behavior: auto; }
        .reveal {
          opacity: 1 !important;
          transform: none !important;
          transition: none !important;
        }
      }
    
</style>


      <section
        class="section-shell border-b border-sky-100 reveal"
        style="{{ $heroSectionStyle }}"
      >
        <div class="mx-auto max-w-7xl px-4 py-12 sm:py-14 lg:py-16">
          <p class="text-sm font-medium text-slate-500"><a href="{{ $homeUrl }}" class="hover:text-brand-blue">{{ $homeLabel }}</a> / {{ $pageLabel }}</p>
          <div class="mt-5">
            <h1 class="max-w-4xl text-[2.15rem] font-black leading-[1.05] text-brand-blue sm:text-[2.8rem] lg:text-[3.5rem]">{{ $heroTitle }}</h1>
          </div>
        </div>
      </section>

      <section class="section-shell reveal bg-[linear-gradient(180deg,_rgba(255,255,255,0.94),_rgba(236,248,255,0.55))] py-14 sm:py-16 lg:py-20">
        <div class="mx-auto grid max-w-7xl gap-8 px-4 lg:grid-cols-[1fr_0.96fr] lg:items-start lg:gap-12">
          <div class="space-y-6">
            <article class="panel-card rounded-[28px] p-7 pt-8 sm:p-8 sm:pt-9">
              <p class="text-sm font-bold uppercase tracking-[0.22em] text-brand-blue">{{ $whoWeAreTitle }}</p>
              <div class="mt-4 text-lg leading-8 text-slate-600 [&_p]:mb-3 [&_ul]:ml-5 [&_ul]:list-disc [&_ol]:ml-5 [&_ol]:list-decimal">{!! $whoWeAreBody ?? 'PT. Systech Talenta Digital (DigiTalent) is a technology company and strategic partner for digital transformation. We focus on two core services: IT Training and IT Outsourcing. We believe digital progress depends on skilled people who can adapt and perform in real environments.' !!}</div>
            </article>

            <article class="panel-card rounded-[28px] p-7 pt-8 sm:p-8 sm:pt-9">
              <p class="text-sm font-bold uppercase tracking-[0.22em] text-brand-blue">{{ $whereWeComeFromTitle }}</p>
              <div class="mt-4 text-lg leading-8 text-slate-600 [&_p]:mb-3 [&_ul]:ml-5 [&_ul]:list-disc [&_ol]:ml-5 [&_ol]:list-decimal">{!! $whereWeComeFromBody ?? 'DigiTalent is part of SGI Asia Group, an IT group established in 2013. We originated from the training division of PT. Systech Global Informasi and later became an independent company. With strong industry experience and networks, we address two key needs: developing competent professionals and providing industry-ready talent. Our goal is to connect industry demands with available skills through structured training and reliable outsourcing services.' !!}</div>
            </article>

            <article class="panel-card rounded-[28px] p-7 pt-8 sm:p-8 sm:pt-9">
              <p class="text-sm font-bold uppercase tracking-[0.22em] text-brand-blue">{{ $commitmentTitle }}</p>
              <div class="mt-4 text-lg leading-8 text-slate-600 [&_p]:mb-3 [&_ul]:ml-5 [&_ul]:list-disc [&_ol]:ml-5 [&_ol]:list-decimal">{!! $commitmentBody ?? 'Our commitment is to bridge the gap between industry demands and talent availability. Through structured training programs and flexible, trusted outsourcing services, we empower individuals and organizations to excel in a competitive digital future.' !!}</div>
            </article>
          </div>

          <aside class="space-y-5">
            <div class="story-photo min-h-[320px] rounded-[30px] shadow-soft sm:min-h-[380px] lg:min-h-[460px]" style="--photo: url('{{ $aboutPhotoUrl }}')"></div>

            <div class="grid gap-4 sm:grid-cols-2">
              <div class="rounded-[24px] border border-brand-blue/15 bg-brand-sky/90 p-5">
                <p class="text-xs font-semibold uppercase tracking-[0.18em] text-slate-500">{{ $foundedLabel }}</p>
                <p class="mt-2 text-2xl font-black text-brand-navy">{{ $foundedValue }}</p>
              </div>
              <div class="rounded-[24px] border border-brand-blue/15 bg-white/95 p-5">
                <p class="text-xs font-semibold uppercase tracking-[0.18em] text-slate-500">{{ $groupLabel }}</p>
                <p class="mt-2 text-2xl font-black text-brand-navy">{{ $groupValue }}</p>
              </div>
            </div>

            <div class="panel-card rounded-[28px] p-6 pt-8">
              <p class="text-sm font-bold uppercase tracking-[0.22em] text-brand-blue">{{ $snapshotSectionTitle }}</p>
              <div class="mt-5 grid gap-3">
                <div class="rounded-2xl border border-brand-blue/15 bg-white/90 px-4 py-4">
                  <p class="text-lg font-bold text-brand-navy">{{ $focus1Title }}</p>
                  <p class="mt-1 leading-7 text-slate-600">{{ $focus1Body }}</p>
                </div>
                <div class="rounded-2xl border border-brand-blue/15 bg-white/90 px-4 py-4">
                  <p class="text-lg font-bold text-brand-navy">{{ $focus2Title }}</p>
                  <p class="mt-1 leading-7 text-slate-600">{{ $focus2Body }}</p>
                </div>
              </div>
            </div>

          </aside>
        </div>
      </section>

      <script>
        document.addEventListener('DOMContentLoaded', function () {
          const revealElements = document.querySelectorAll('.reveal');
          const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

          if (!reduceMotion && 'IntersectionObserver' in window) {
            const revealObserver = new IntersectionObserver((entries) => {
              entries.forEach((entry) => {
                if (!entry.isIntersecting) return;
                entry.target.classList.add('is-visible');
                revealObserver.unobserve(entry.target);
              });
            }, { threshold: 0.16 });

            revealElements.forEach((element) => revealObserver.observe(element));
            return;
          }

          revealElements.forEach((element) => element.classList.add('is-visible'));
        });
      </script>

@endsection
