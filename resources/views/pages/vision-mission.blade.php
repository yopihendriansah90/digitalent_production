@extends('layouts.app')

@section('content')
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


      <section class="section-shell border-b border-sky-100 bg-[linear-gradient(135deg,_rgba(236,248,255,0.96),_rgba(255,255,255,0.98)_42%,_rgba(127,215,255,0.22)_100%)] reveal">
        <div class="mx-auto max-w-7xl px-4 py-12 sm:py-14 lg:py-16">
          <p class="text-sm font-medium text-slate-500"><a href="{{ route('home') }}" class="hover:text-brand-blue">Home</a> / Vision & Mission</p>
          <h1 class="mt-5 max-w-4xl text-[2.1rem] font-black leading-[1.05] text-brand-blue sm:text-[2.7rem] lg:text-[3.5rem]">Vision & Mission</h1>
        </div>
      </section>

      <section class="section-shell reveal bg-[linear-gradient(180deg,_rgba(255,255,255,0.94),_rgba(236,248,255,0.55))] py-14 sm:py-16 lg:py-20">
        <div class="mx-auto max-w-7xl space-y-8 px-4 lg:space-y-10">
          <article class="panel-card rounded-[28px] p-7 pt-8 sm:p-8 sm:pt-9">
            <p class="text-sm font-bold uppercase tracking-[0.22em] text-brand-blue">Vision</p>
            <p class="mt-4 max-w-5xl text-[1.35rem] font-black leading-[1.5] text-brand-blue sm:text-[1.6rem] sm:leading-[1.55]">To be the leading strategic partner in developing and providing superior, innovative, and globally competitive digital talent to support international-standard digital transformation</p>
          </article>

          <div class="panel-card rounded-[30px] p-6 pt-8 sm:p-7 sm:pt-9">
            <p class="text-sm font-bold uppercase tracking-[0.22em] text-brand-blue">Mission</p>
            <div class="mt-5 grid gap-4 lg:grid-cols-2">
              <div class="rounded-2xl border border-brand-blue/15 bg-white/90 px-4 py-4">
                <p class="text-sm font-extrabold text-brand-orange">01</p>
                <p class=" leading-7 mt-4 text-slate-600">Provide high-quality IT training and certification programs to produce job-ready digital talent that meets global standards.</p>
              </div>
              <div class="rounded-2xl border border-brand-blue/15 bg-white/90 px-4 py-4">
                <p class="text-sm font-extrabold text-brand-orange">02</p>
                <p class=" leading-7 mt-4 text-slate-600">Establish a professional and reliable outsourcing ecosystem to fulfill the human resource and IT solution needs of our partner companies.</p>
              </div>
              <div class="rounded-2xl border border-brand-blue/15 bg-white/90 px-4 py-4">
                <p class="text-sm font-extrabold text-brand-orange">03</p>
                <p class=" leading-7 mt-4 text-slate-600">Forge strategic collaborations with industries, educational institutions, and the government to strengthen the national digital talent supply.</p>
              </div>
              <div class="rounded-2xl border border-brand-blue/15 bg-white/90 px-4 py-4">
                <p class="text-sm font-extrabold text-brand-orange">04</p>
                <p class=" leading-7 mt-4 text-slate-600">Drive continuous innovation in learning systems, recruitment processes, and technology project execution.</p>
              </div>
              <div class="rounded-2xl border border-brand-blue/15 bg-white/90 px-4 py-4 lg:col-span-2">
                <p class="text-sm font-extrabold text-brand-orange">05</p>
                <p class=" leading-7 mt-4 text-slate-600">Uphold integrity, professionalism, and client satisfaction in every training and technology service delivered.</p>
              </div>
            </div>
          </div>
        </div>
      </section>
    
@endsection
