@extends('layouts.app')

@section('content')
@php
  $trainingBlock = $sections['training_blocks'] ?? null;
  $outsourcingBlock = $sections['outsourcing_blocks'] ?? null;
  $trainingBlockItems = $trainingBlock?->items ?? collect();
  $outsourcingBlockItems = $outsourcingBlock?->items ?? collect();
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
      .hero-entrance [data-hero-item="crumb"] { animation-delay: 100ms; }
      .hero-entrance [data-hero-item="title"] { animation-delay: 200ms; }
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
        opacity: 0;
        transform: translateY(24px);
        transition: opacity 760ms cubic-bezier(0.22, 1, 0.36, 1), transform 760ms cubic-bezier(0.22, 1, 0.36, 1);
      }
      .reveal.is-visible {
        opacity: 1;
        transform: translateY(0);
      }
      .stagger-group .stagger-item {
        opacity: 0;
        transform: translateY(24px);
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
      .section-card {
        position: relative;
        min-height: 100%;
        border: 1px solid rgba(0, 154, 223, 0.14);
        background:
          radial-gradient(circle at top right, rgba(127, 215, 255, 0.22), transparent 38%),
          linear-gradient(180deg, #ffffff, #f4fbff);
        box-shadow: 0 16px 38px rgba(9, 70, 138, 0.08);
        transition: transform 240ms ease, box-shadow 240ms ease, border-color 240ms ease;
      }
      .section-card::before {
        content: "";
        position: absolute;
        left: 24px;
        top: 0;
        width: 58px;
        height: 4px;
        border-radius: 999px;
        background: linear-gradient(90deg, #f3a836, #009adf);
      }
      .section-card:hover {
        transform: translateY(-4px);
        border-color: rgba(0, 154, 223, 0.24);
        box-shadow: 0 24px 52px rgba(9, 70, 138, 0.12);
      }
      .profile-grid,
      .selection-grid,
      .outsourcing-grid {
        display: grid;
        gap: 20px;
      }
      .overview-grid,
      .support-grid {
        display: grid;
        gap: 20px;
      }
      .training-domain-grid {
        display: grid;
        gap: 12px;
      }
      .domain-chart-card {
        border: 1px solid rgba(0, 154, 223, 0.14);
        background:
          radial-gradient(circle at top left, rgba(127, 215, 255, 0.16), transparent 34%),
          linear-gradient(180deg, #f8fcff, #eef7ff);
        box-shadow: 0 20px 44px rgba(9, 70, 138, 0.1);
      }
      .domain-chart-layout {
        display: grid;
        gap: 28px;
      }
      .domain-chart-figure {
        overflow: hidden;
        border-radius: 24px;
        border: 1px solid rgba(0, 154, 223, 0.14);
        background: rgba(255, 255, 255, 0.96);
        box-shadow: 0 18px 38px rgba(9, 70, 138, 0.08);
        opacity: 0;
        transform: translateY(18px) scale(0.985);
        transition:
          opacity 760ms cubic-bezier(0.22, 1, 0.36, 1),
          transform 760ms cubic-bezier(0.22, 1, 0.36, 1),
          box-shadow 240ms ease,
          border-color 240ms ease;
      }
      .domain-chart-card.is-visible .domain-chart-figure {
        opacity: 1;
        transform: translateY(0) scale(1);
      }
      .domain-chart-figure:hover {
        border-color: rgba(0, 154, 223, 0.22);
        box-shadow: 0 24px 52px rgba(9, 70, 138, 0.12);
      }
      .domain-chart-figure img {
        display: block;
        width: 100%;
        height: auto;
        transform: scale(1.01);
        transition: transform 900ms cubic-bezier(0.22, 1, 0.36, 1);
      }
      .domain-chart-card.is-visible .domain-chart-figure img {
        transform: scale(1);
      }
      .domain-chart-figure:hover img {
        transform: scale(1.015);
      }
      .training-photo {
        background-image: linear-gradient(180deg, rgba(9, 70, 138, 0.08), rgba(9, 70, 138, 0.22)), var(--photo);
        background-size: cover;
        background-position: center;
      }
      .domain-chip {
        border-radius: 18px;
        border: 1px solid rgba(0, 154, 223, 0.14);
        background: #fff;
        padding: 14px 16px;
        color: #40526d;
        box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.9);
      }
      .mentored-grid {
        display: grid;
        gap: 12px;
      }
      .mentored-item {
        position: relative;
        overflow: hidden;
        border-radius: 18px;
        border: 1px solid rgba(0, 154, 223, 0.14);
        background: #fff;
        padding: 18px 16px 16px;
        transition: transform 220ms ease, box-shadow 220ms ease, border-color 220ms ease;
      }
      .mentored-item::before {
        content: "";
        position: absolute;
        left: 16px;
        top: 0;
        width: 64px;
        height: 4px;
        border-radius: 999px;
        background: linear-gradient(90deg, #f3a836 0 45%, #009adf 45% 100%);
      }
      .mentored-item:hover {
        transform: translateY(-3px);
        border-color: rgba(0, 154, 223, 0.24);
        box-shadow: 0 18px 38px rgba(9, 70, 138, 0.1);
      }
      .mentored-item-title {
        color: #09468a;
      }
      .mentored-icon {
        width: 80px;
        height: 80px;
        object-fit: contain;
      }
      .talent-profile-icon {
        width: 80px;
        height: 80px;
        object-fit: contain;
      }
      .detail-copy {
        color: #51627c;
      }
      .kicker {
        color: #f3a836;
      }
      @media (min-width: 1280px) {
        .overview-grid,
        .support-grid {
          grid-template-columns: repeat(2, minmax(0, 1fr));
        }
        .profile-grid {
          grid-template-columns: repeat(4, minmax(0, 1fr));
        }
        .selection-grid {
          grid-template-columns: repeat(2, minmax(0, 1fr));
        }
        .training-domain-grid {
          grid-template-columns: repeat(2, minmax(0, 1fr));
        }
        .outsourcing-grid {
          grid-template-columns: repeat(2, minmax(0, 1fr));
        }
        .domain-chart-layout {
          grid-template-columns: 0.72fr 1.28fr;
          align-items: center;
        }
      }
      @media (max-width: 1023px) {
        .domain-chart-layout {
          gap: 22px;
        }
      }
      @media (prefers-reduced-motion: reduce) {
        html { scroll-behavior: auto; }
        .hero-entrance [data-hero-item],
        .reveal,
        .stagger-group .stagger-item,
        .section-card,
        .domain-chart-figure,
        .domain-chart-figure img {
          opacity: 1 !important;
          transform: none !important;
          transition: none !important;
          animation: none !important;
        }
      }
    
</style>


      <section class="hero-entrance overflow-hidden border-b border-sky-100 bg-[linear-gradient(135deg,_rgba(236,248,255,0.96),_rgba(255,255,255,0.98)_42%,_rgba(127,215,255,0.22)_100%)]">
        <div class="mx-auto max-w-7xl px-4 py-12 sm:py-14 lg:py-16">
          <div>
            <p class="text-sm font-medium text-slate-500" data-hero-item="crumb"><a href="{{ route('home') }}" class="hover:text-brand-blue">Home</a> / Services</p>
            <h1 class="mt-5 max-w-4xl text-[2.15rem] font-black leading-[1.04] text-brand-blue sm:text-[2.8rem] lg:text-[3.6rem]" data-hero-item="title">{{ $page?->hero_title ?? 'IT Training and IT Outsourcing' }}</h1>
            <div class="mt-8 grid max-w-3xl gap-4 sm:grid-cols-2">
              <div class="rounded-[24px] border border-brand-blue/15 bg-white/92 px-5 py-5 shadow-soft">
                <p class="text-xs font-semibold uppercase tracking-[0.18em] text-slate-500">Core Services</p>
                <p class=" text-lg font-black leading-snug mt-4 text-brand-navy">Capability development and deployment-ready IT talent.</p>
              </div>
              <div class="rounded-[24px] border border-brand-blue/15 bg-brand-sky/90 px-5 py-5 shadow-soft">
                <p class="text-xs font-semibold uppercase tracking-[0.18em] text-slate-500">Delivery Standard</p>
                <p class=" text-lg font-black leading-snug mt-4 text-brand-navy">Quality, efficiency, high performance, and data security.</p>
              </div>
            </div>
          </div>
        </div>
      </section>

      @if (($trainingBlock?->is_active ?? true) === true)
      <section class="reveal bg-[linear-gradient(180deg,_rgba(255,255,255,0.94),_rgba(236,248,255,0.5))] py-14 sm:py-16 lg:py-20">
        <div class="mx-auto max-w-7xl px-4">
          <div>
            <p class="text-sm font-bold uppercase tracking-[0.22em] text-brand-blue">{{ $trainingBlock?->section_title ?: 'IT Training' }}</p>
            <h2 class="mt-[30px] text-3xl font-black text-brand-blue lg:text-[2.7rem]">Industry-relevant IT training and certification preparation.</h2>
            <div class="mt-4 max-w-4xl text-lg leading-8 text-slate-600 [&_p]:mb-3 [&_ul]:ml-5 [&_ul]:list-disc [&_ol]:ml-5 [&_ol]:list-decimal">
              {!! $trainingBlock?->section_description ?: 'We accommodate a wide range of industry-relevant IT training and certification needs. We ensure that participants gain in-depth understanding and practical expertise through dedicated mentoring in preparation for certification exams.' !!}
            </div>
          </div>

          <div class="overview-grid stagger-group mt-8">
            @forelse ($trainingBlockItems as $item)
              <article class="section-card stagger-item rounded-[26px] p-6 sm:p-7">
                <p class="kicker text-sm font-extrabold uppercase tracking-[0.18em]">{{ $item->title }}</p>
                <div class="detail-copy mt-4 text-lg leading-8 text-slate-700 [&_p]:mb-3 [&_ul]:ml-5 [&_ul]:list-disc [&_ol]:ml-5 [&_ol]:list-decimal">{!! $item->description !!}</div>
              </article>
            @empty
              <article class="section-card stagger-item rounded-[26px] p-6 sm:p-7">
                <p class="kicker text-sm font-extrabold uppercase tracking-[0.18em]">Fundamental to Advanced Training</p>
                <p class="detail-copy mt-4 text-lg leading-8">We offer a specialized Mentored Learning system where professionals can learn with flexible schedules and affordable pricing.</p>
              </article>
            @endforelse
          </div>

          <div class="domain-chart-card reveal mt-8 rounded-[30px] p-5 sm:p-8">
            <div class="domain-chart-layout">
              <div class="max-w-xl">
                <p class="kicker text-sm font-extrabold uppercase tracking-[0.18em]">Domain Training</p>
                <h3 class="mt-[30px] text-2xl font-black text-brand-blue">IT Training Domain</h3>
                <p class="detail-copy mt-4 text-lg leading-8">DigiTalent accommodates a broad range of industry-relevant training domains to support both foundational capability building and specialized professional development.</p>
              </div>
              <div class="mt-8 lg:mt-0">
                <figure class="domain-chart-figure">
                  <img src="/template/Logo/assets/trainging.png" alt="Diagram IT Training Domain DigiTalent" loading="lazy" />
                </figure>
              </div>
            </div>
          </div>

          <div class="reveal mt-8 rounded-[30px] border border-brand-blue/15 bg-white/92 p-5 shadow-soft sm:p-8">
            <div class="max-w-3xl">
              <p class="kicker text-sm font-extrabold uppercase tracking-[0.18em]">Mentored Learning</p>
              <h3 class="mt-[30px] text-2xl font-black text-brand-blue">A structured learning model for practical capability development.</h3>
            </div>
            <div class="mt-6 grid gap-5 lg:grid-cols-[0.9fr_1.1fr] lg:items-start">
              <div class="rounded-[26px] border border-slate-200 bg-white p-3 shadow-soft">
                <div class="training-photo min-h-[220px] rounded-[20px] sm:min-h-[320px]" style="--photo: url('https://www.sgi-asia.co.id/Activities/CSAS.jpg')"></div>
              </div>
              <div class="mentored-grid">
                <div class="mentored-item">
                  <img class="mentored-icon" src="/template/Logo/assets/Mentored Learning/Direct Online Access.png" alt="Direct Online Access icon" loading="lazy" />
                  <p class="mentored-item-title font-bold">Direct Online Access</p>
                  <p class="mt-2 text-slate-600">Interactive discussions with Trainers.</p>
                </div>
                <div class="mentored-item">
                  <img class="mentored-icon" src="/template/Logo/assets/Mentored Learning/Active Learning.png" alt="Active Learning icon" loading="lazy" />
                  <p class="mentored-item-title font-bold">Active Learning</p>
                  <p class="mt-2 text-slate-600">Supported by virtual technology.</p>
                </div>
                <div class="mentored-item">
                  <img class="mentored-icon" src="/template/Logo/assets/Mentored Learning/Hands-on Labs.png" alt="Hands-on Labs icon" loading="lazy" />
                  <p class="mentored-item-title font-bold">Hands-on Labs</p>
                  <p class="mt-2 text-slate-600">Practical training environments.</p>
                </div>
                <div class="mentored-item">
                  <img class="mentored-icon" src="/template/Logo/assets/Mentored Learning/Project-Based Assessment.png" alt="Project-Based Assessments icon" loading="lazy" />
                  <p class="mentored-item-title font-bold">Project-Based Assessments</p>
                  <p class="mt-2 text-slate-600">Evaluation through real-work projects.</p>
                </div>
                <div class="mentored-item md:col-span-2">
                  <img class="mentored-icon" src="/template/Logo/assets/Mentored Learning/Real-World Scenariost.png" alt="Real-World Scenarios icon" loading="lazy" />
                  <p class="mentored-item-title font-bold">Real-World Scenarios</p>
                  <p class="mt-2 text-slate-600">Equipped with case studies and industry examples.</p>
                </div>
              </div>
            </div>
          </div>

          <div class="support-grid stagger-group mt-8">
            <article class="section-card stagger-item rounded-[26px] p-6 sm:p-7">
              <p class="kicker text-sm font-extrabold uppercase tracking-[0.18em]">Flexible Delivery Methods</p>
              <p class="detail-copy mt-4 text-lg leading-8">We accommodate your needs through Public Classes (Online or Offline), Hybrid learning, as well as Corporate In-House Training and ODP (Office Development Program) tailored for your team.</p>
            </article>
            <article class="section-card stagger-item rounded-[26px] p-6 sm:p-7">
              <p class="kicker text-sm font-extrabold uppercase tracking-[0.18em]">Learning Outcome Focus</p>
              <p class="detail-copy mt-4 text-lg leading-8">We ensure that participants gain in-depth understanding and practical expertise through dedicated mentoring in preparation for certification exams.</p>
            </article>
          </div>
        </div>
      </section>
      @endif

      @if (($outsourcingBlock?->is_active ?? true) === true)
      <section class="reveal border-y border-brand-blue/10 bg-[linear-gradient(180deg,_rgba(236,248,255,0.92),_rgba(255,255,255,0.98))] py-14 sm:py-16 lg:py-20">
        <div class="mx-auto max-w-7xl px-4">
          <div>
            <p class="text-sm font-bold uppercase tracking-[0.22em] text-brand-blue">{{ $outsourcingBlock?->section_title ?: 'IT Outsourcing' }}</p>
            <h2 class="mt-[30px] text-3xl font-black text-brand-blue lg:text-[2.7rem]">Top-tier IT experts for short-term and long-term engagements.</h2>
            <div class="mt-4 max-w-4xl text-lg leading-8 text-slate-600 [&_p]:mb-3 [&_ul]:ml-5 [&_ul]:list-disc [&_ol]:ml-5 [&_ol]:list-decimal">
              {!! $outsourcingBlock?->section_description ?: 'We assist companies in sourcing and managing top-tier IT experts for both short-term and long-term engagements. Through our flexible outsourcing model, we ensure cost efficiency, high-quality performance, and data security.' !!}
            </div>
          </div>

          <div class="overview-grid stagger-group mt-8">
            @forelse ($outsourcingBlockItems as $item)
              <article class="section-card stagger-item rounded-[26px] p-6 sm:p-7">
                <p class="kicker text-sm font-extrabold uppercase tracking-[0.18em]">{{ $item->title }}</p>
                <div class="detail-copy mt-4 text-lg leading-8 text-slate-700 [&_p]:mb-3 [&_ul]:ml-5 [&_ul]:list-disc [&_ol]:ml-5 [&_ol]:list-decimal">{!! $item->description !!}</div>
              </article>
            @empty
              <article class="section-card stagger-item rounded-[26px] p-6 sm:p-7">
                <p class="kicker text-sm font-extrabold uppercase tracking-[0.18em]">Overview</p>
                <p class="detail-copy mt-4 text-lg leading-8">We assist companies in sourcing and managing top-tier IT experts for both short-term and long-term engagements.</p>
              </article>
            @endforelse
          </div>

          <div class="reveal mt-8 rounded-[30px] border border-brand-blue/15 bg-white/92 p-5 shadow-soft sm:p-8">
            <div class="max-w-3xl">
              <p class="kicker text-sm font-extrabold uppercase tracking-[0.18em]">Talent Profiles</p>
              <h3 class="mt-[30px] text-2xl font-black text-brand-blue">Deployment-ready roles for operational and project needs.</h3>
            </div>
            <div class="profile-grid mt-6">
              <article class="section-card rounded-[24px] p-5">
                <img class="talent-profile-icon" src="/template/Logo/assets/Talent Profiles/Dedicated IT Staff.png" alt="Dedicated IT Staff icon" />
                <h4 class="text-xl font-black text-brand-blue">Dedicated IT Staff</h4>
                <p class="detail-copy mt-3 leading-7">Programmers, Network Engineers, and Data Analysts ready for direct business deployment.</p>
              </article>
              <article class="section-card rounded-[24px] p-5">
                <img class="talent-profile-icon" src="/template/Logo/assets/Talent Profiles/Managed IT Services.png" alt="Managed IT Services icon" />
                <h4 class="text-xl font-black text-brand-blue">Managed IT Services</h4>
                <p class="detail-copy mt-3 leading-7">Managed operational support for stable and flexible IT service execution.</p>
              </article>
              <article class="section-card rounded-[24px] p-5">
                <img class="talent-profile-icon" src="/template/Logo/assets/Talent Profiles/Technical Support & Maintenance.png" alt="Technical Support & Maintenance icon" />
                <h4 class="text-xl font-black text-brand-blue">Technical Support & Maintenance</h4>
                <p class="detail-copy mt-3 leading-7">Technical support and maintenance to sustain reliable day-to-day operations.</p>
              </article>
              <article class="section-card rounded-[24px] p-5">
                <img class="talent-profile-icon" src="/template/Logo/assets/Talent Profiles/Project-Based IT Team.png" alt="Project-Based IT Teams icon" />
                <h4 class="text-xl font-black text-brand-blue">Project-Based IT Teams</h4>
                <p class="detail-copy mt-3 leading-7">Focused IT teams aligned to defined scope, delivery target, and project timeline.</p>
              </article>
            </div>
          </div>

          <div class="reveal mt-8 rounded-[30px] border border-brand-blue/15 bg-white/92 p-5 shadow-soft sm:p-8">
            <div class="max-w-3xl">
              <p class="kicker text-sm font-extrabold uppercase tracking-[0.18em]">Professional Selection Process</p>
              <h3 class="mt-[30px] text-2xl font-black text-brand-blue">Structured validation to reduce hiring risk and speed deployment.</h3>
            </div>
            <div class="selection-grid mt-6">
              <div class="mentored-item">
                <p class="mentored-item-title font-bold">Pre-qualified Talent</p>
                <p class="mt-2 text-slate-600">Pre-qualified talent with verified experience and certifications.</p>
              </div>
              <div class="mentored-item">
                <p class="mentored-item-title font-bold">Faster Onboarding</p>
                <p class="mt-2 text-slate-600">Faster onboarding with deployment-ready professionals.</p>
              </div>
              <div class="mentored-item">
                <p class="mentored-item-title font-bold">Lower Hiring Risk</p>
                <p class="mt-2 text-slate-600">Lower hiring risk through structured screening and validation.</p>
              </div>
              <div class="mentored-item">
                <p class="mentored-item-title font-bold">Immediate Productivity</p>
                <p class="mt-2 text-slate-600">Immediate productivity from teams prepared for real-world environments.</p>
              </div>
            </div>
          </div>

        </div>
      </section>
      @endif

      <script>
        document.addEventListener('DOMContentLoaded', function () {
          const revealElements = document.querySelectorAll('.reveal, .stagger-group, .domain-chart-card');
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
