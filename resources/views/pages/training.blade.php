@extends('layouts.app')

@section('content')
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
    
</style>


      <section class="border-b border-brand-orange/30 bg-[linear-gradient(160deg,_#f0a530_0%,_#f4b651_46%,_#f8cd85_100%)] py-14 lg:py-20">
        <div class="mx-auto max-w-7xl px-4">
          <p class="text-sm font-medium text-white/92"><a href="{{ route('home') }}" class="hover:text-white">Home</a> / Training</p>
          <h1 class="mt-5 max-w-4xl text-[2.15rem] font-black leading-[1.05] text-white sm:text-[2.8rem] lg:text-[3.5rem]">Training catalog structured by domain, learning format, and industry relevance.</h1>
          <div class="mt-8 grid max-w-3xl gap-4 sm:grid-cols-2">
            <div class="rounded-[24px] border border-brand-navy/14 bg-white px-5 py-5 shadow-[0_20px_44px_rgba(9,70,138,0.14)]">
              <p class="text-xs font-semibold uppercase tracking-[0.18em] text-brand-navy/70">Coverage</p>
              <div class="mt-2 h-[3px] w-14 rounded-full bg-[linear-gradient(90deg,_#f3a836_0_45%,_#009adf_45%_100%)]"></div>
              <p class="mt-4 text-lg font-black leading-snug text-brand-navy">Seven domain categories from GRC to project management.</p>
            </div>
            <div class="rounded-[24px] border border-brand-navy/14 bg-white px-5 py-5 shadow-[0_20px_44px_rgba(9,70,138,0.14)]">
              <p class="text-xs font-semibold uppercase tracking-[0.18em] text-brand-navy/70">Learning Format</p>
              <div class="mt-2 h-[3px] w-14 rounded-full bg-[linear-gradient(90deg,_#f3a836_0_45%,_#009adf_45%_100%)]"></div>
              <p class="mt-4 text-lg font-black leading-snug text-brand-navy">Catalog-ready programs for structured and industry-relevant learning paths.</p>
            </div>
          </div>
        </div>
      </section>

      <section class="bg-[linear-gradient(180deg,_rgba(255,255,255,0.94),_rgba(236,248,255,0.5))] py-14 lg:py-20">
        <div class="mx-auto max-w-7xl px-4">
          <div class="grid gap-5 md:grid-cols-2 xl:grid-cols-4">
            <a class="training-card rounded-[26px] p-6 pt-7" href="#">
              <p class="text-sm font-bold uppercase tracking-[0.2em] text-brand-blue">Domain 01</p>
              <h2 class="mt-4 text-2xl font-black text-brand-blue">GRC</h2>
              <p class=" leading-7 mt-4 text-slate-600">Governance, Risk, & Compliance programs for security and regulatory readiness.</p>
              <span class="mt-6 inline-flex text-sm font-bold text-brand-orange">Catalog Link Placeholder</span>
            </a>
            <a class="training-card rounded-[26px] p-6 pt-7" href="#">
              <p class="text-sm font-bold uppercase tracking-[0.2em] text-brand-blue">Domain 02</p>
              <h2 class="mt-4 text-2xl font-black text-brand-blue">IT Operations</h2>
              <p class=" leading-7 mt-4 text-slate-600">Infrastructure, system operations, and operational reliability learning paths.</p>
              <span class="mt-6 inline-flex text-sm font-bold text-brand-orange">Catalog Link Placeholder</span>
            </a>
            <a class="training-card rounded-[26px] p-6 pt-7" href="#">
              <p class="text-sm font-bold uppercase tracking-[0.2em] text-brand-blue">Domain 03</p>
              <h2 class="mt-4 text-2xl font-black text-brand-blue">IT Architecture</h2>
              <p class=" leading-7 mt-4 text-slate-600">Architecture design programs for scalable and business-aligned systems.</p>
              <span class="mt-6 inline-flex text-sm font-bold text-brand-orange">Catalog Link Placeholder</span>
            </a>
            <a class="training-card rounded-[26px] p-6 pt-7" href="#">
              <p class="text-sm font-bold uppercase tracking-[0.2em] text-brand-blue">Domain 04</p>
              <h2 class="mt-4 text-2xl font-black text-brand-blue">Software Development</h2>
              <p class=" leading-7 mt-4 text-slate-600">Practical software engineering programs from foundations to advanced delivery.</p>
              <span class="mt-6 inline-flex text-sm font-bold text-brand-orange">Catalog Link Placeholder</span>
            </a>
            <a class="training-card rounded-[26px] p-6 pt-7" href="#">
              <p class="text-sm font-bold uppercase tracking-[0.2em] text-brand-blue">Domain 05</p>
              <h2 class="mt-4 text-2xl font-black text-brand-blue">Cybersecurity</h2>
              <p class=" leading-7 mt-4 text-slate-600">Training for cyber defense, threat awareness, and security implementation.</p>
              <span class="mt-6 inline-flex text-sm font-bold text-brand-orange">Catalog Link Placeholder</span>
            </a>
            <a class="training-card rounded-[26px] p-6 pt-7" href="#">
              <p class="text-sm font-bold uppercase tracking-[0.2em] text-brand-blue">Domain 06</p>
              <h2 class="mt-4 text-2xl font-black text-brand-blue">Management & IT BA</h2>
              <p class=" leading-7 mt-4 text-slate-600">Programs for business analysis, governance, and managerial IT capability.</p>
              <span class="mt-6 inline-flex text-sm font-bold text-brand-orange">Catalog Link Placeholder</span>
            </a>
            <a class="training-card rounded-[26px] p-6 pt-7" href="#">
              <p class="text-sm font-bold uppercase tracking-[0.2em] text-brand-blue">Domain 07</p>
              <h2 class="mt-4 text-2xl font-black text-brand-blue">Project Management</h2>
              <p class=" leading-7 mt-4 text-slate-600">Project planning, delivery control, and execution management for IT teams.</p>
              <span class="mt-6 inline-flex text-sm font-bold text-brand-orange">Catalog Link Placeholder</span>
            </a>
            <a class="training-card rounded-[26px] p-6 pt-7" href="#">
              <p class="text-sm font-bold uppercase tracking-[0.2em] text-brand-blue">Domain 08</p>
              <h2 class="mt-4 text-2xl font-black text-brand-blue">Data & Artificial Intelligence</h2>
              <p class=" leading-7 mt-4 text-slate-600">Data analysis, AI literacy, and applied intelligence programs for modern teams.</p>
              <span class="mt-6 inline-flex text-sm font-bold text-brand-orange">Catalog Link Placeholder</span>
            </a>
          </div>
        </div>
      </section>

    
@endsection
