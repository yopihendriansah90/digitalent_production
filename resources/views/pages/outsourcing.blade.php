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


      <section class="bg-[linear-gradient(135deg,_#09468a,_#0b6ebd_52%,_#009adf_100%)] py-14 text-white lg:py-20">
        <div class="mx-auto max-w-7xl px-4">
          <p class="text-sm font-medium text-white/70"><a href="{{ route('home') }}" class="hover:text-white">Home</a> / Outsourcing</p>
          <h1 class="mt-5 max-w-4xl text-[2.1rem] font-black leading-[1.04] sm:text-[2.8rem] lg:text-[3.5rem]">Top-tier IT experts for short-term and long-term business engagements.</h1>
          <div class="mt-8 grid max-w-3xl gap-4 sm:grid-cols-2">
            <div class="rounded-[24px] border border-white/15 bg-white/10 px-5 py-5 backdrop-blur-sm">
              <p class="text-xs font-semibold uppercase tracking-[0.18em] text-white/70">Talent Scope</p>
              <p class=" text-lg font-black leading-snug mt-4 text-white">Dedicated staff, managed services, and project-based IT teams.</p>
            </div>
            <div class="rounded-[24px] border border-white/15 bg-white/10 px-5 py-5 backdrop-blur-sm">
              <p class="text-xs font-semibold uppercase tracking-[0.18em] text-white/70">Engagement Model</p>
              <p class=" text-lg font-black leading-snug mt-4 text-white">Flexible support for operational continuity and business delivery needs.</p>
            </div>
          </div>
        </div>
      </section>

      <section class="bg-[linear-gradient(180deg,_rgba(255,255,255,0.94),_rgba(236,248,255,0.5))] py-14 lg:py-20">
        <div class="mx-auto max-w-7xl px-4">
          <div class="grid gap-5 md:grid-cols-2 xl:grid-cols-4">
            <article class="outsourcing-card rounded-[26px] p-6 pt-7">
              <img class="outsourcing-icon" src="/template/Logo/assets/Talent Profiles/Dedicated IT Staff.png" alt="Dedicated IT Staff Icon" />
              <h2 class="text-2xl font-black text-brand-blue">Dedicated IT Staff</h2>
              <p class=" leading-7 mt-4 text-slate-600">Programmers, Network Engineers, Data Analysts, and other deployment-ready professionals.</p>
            </article>
            <article class="outsourcing-card rounded-[26px] p-6 pt-7">
              <img class="outsourcing-icon" src="/template/Logo/assets/Talent Profiles/Managed IT Services.png" alt="Managed IT Services Icon" />
              <h2 class="text-2xl font-black text-brand-blue">Managed IT Services</h2>
              <p class=" leading-7 mt-4 text-slate-600">Flexible service support for operational continuity and managed execution.</p>
            </article>
            <article class="outsourcing-card rounded-[26px] p-6 pt-7">
              <img class="outsourcing-icon" src="/template/Logo/assets/Talent Profiles/Technical Support & Maintenance.png" alt="Technical Support & Maintenance Icon" />
              <h2 class="text-2xl font-black text-brand-blue">Technical Support & Maintenance</h2>
              <p class=" leading-7 mt-4 text-slate-600">Ongoing support, troubleshooting, and maintenance for business-critical systems.</p>
            </article>
            <article class="outsourcing-card rounded-[26px] p-6 pt-7">
              <img class="outsourcing-icon" src="/template/Logo/assets/Talent Profiles/Project-Based IT Team.png" alt="Project-Based IT Team Icon" />
              <h2 class="text-2xl font-black text-brand-blue">Project-Based IT Teams</h2>
              <p class=" leading-7 mt-4 text-slate-600">Cross-functional teams for specific delivery objectives, scope, and timeline.</p>
            </article>
          </div>
        </div>
      </section>

      <section class="bg-[linear-gradient(180deg,_rgba(236,248,255,0.92),_rgba(255,255,255,0.98))] py-14 lg:py-20">
        <div class="mx-auto max-w-7xl px-4">
          <div class="grid gap-6 lg:grid-cols-[0.9fr_1.1fr]">
            <div>
              <p class="text-sm font-bold uppercase tracking-[0.22em] text-brand-blue">Professional Selection Process</p>
              <h2 class="mt-4 text-3xl font-black text-brand-blue">Lower hiring risk with structured validation and deployment-ready talent.</h2>
            </div>
            <div class="grid gap-4 sm:grid-cols-2">
              <div class="benefit-card rounded-[24px] p-5 pt-7">
                <div class="benefit-item">
                  <img class="benefit-check" src="/template/Logo/assets/check.png" alt="Check icon" />
                  <p>Pre-qualified talent with verified experience and certifications.</p>
                </div>
              </div>
              <div class="benefit-card rounded-[24px] p-5 pt-7">
                <div class="benefit-item">
                  <img class="benefit-check" src="/template/Logo/assets/check.png" alt="Check icon" />
                  <p>Faster onboarding with deployment-ready professionals.</p>
                </div>
              </div>
              <div class="benefit-card rounded-[24px] p-5 pt-7">
                <div class="benefit-item">
                  <img class="benefit-check" src="/template/Logo/assets/check.png" alt="Check icon" />
                  <p>Lower hiring risk through structured screening and validation.</p>
                </div>
              </div>
              <div class="benefit-card rounded-[24px] p-5 pt-7">
                <div class="benefit-item">
                  <img class="benefit-check" src="/template/Logo/assets/check.png" alt="Check icon" />
                  <p>Immediate productivity from teams prepared for real-world environments.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    
@endsection
