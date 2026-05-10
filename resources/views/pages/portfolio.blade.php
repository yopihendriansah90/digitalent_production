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
      .gallery-photo {
        background-image: linear-gradient(180deg, rgba(9, 70, 138, 0.08), rgba(9, 70, 138, 0.22)), var(--photo);
        background-size: cover;
        background-position: center;
      }
      .logo-card,
      .portfolio-card {
        position: relative;
        overflow: hidden;
        transition: transform 220ms ease, box-shadow 220ms ease, border-color 220ms ease;
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
        padding-left: 2px;
        padding-right: 2px;
      }
      .clients-grid {
        display: grid;
        gap: 20px;
        grid-template-columns: repeat(2, minmax(0, 1fr));
      }
      @media (min-width: 1024px) {
        .clients-grid {
          grid-template-columns: repeat(4, minmax(0, 1fr));
        }
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
      .logo-card::before,
      .portfolio-card::before {
        content: "";
        position: absolute;
        left: 22px;
        top: 0;
        width: 74px;
        height: 4px;
        border-radius: 999px;
        background: linear-gradient(90deg, #f3a836 0 45%, #009adf 45% 100%);
      }
      .logo-card:hover,
      .portfolio-card:hover {
        transform: translateY(-4px);
        border-color: rgba(0, 154, 223, 0.24);
        box-shadow: 0 24px 52px rgba(9, 70, 138, 0.12);
      }
      .logo-card {
        background: transparent;
      }
      .client-logo-img {
        width: 100%;
        height: 64px;
        object-fit: contain;
        object-position: center;
      }
      .gallery-year-block + .gallery-year-block {
        margin-top: 34px;
      }
      .gallery-year-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
      }
      .gallery-controls {
        display: inline-flex;
        gap: 8px;
      }
      .gallery-control-btn {
        width: 38px;
        height: 38px;
        border-radius: 999px;
        border: 1px solid rgba(0, 154, 223, 0.24);
        background: #fff;
        color: #09468a;
        font-size: 1.05rem;
        font-weight: 700;
        line-height: 1;
      }
      .gallery-track {
        display: flex;
        gap: 18px;
        overflow-x: auto;
        scroll-snap-type: x mandatory;
        scroll-behavior: smooth;
        -webkit-overflow-scrolling: touch;
        scrollbar-width: none;
        cursor: grab;
      }
      .gallery-track:active {
        cursor: grabbing;
      }
      .gallery-track::-webkit-scrollbar {
        display: none;
      }
      .gallery-card-item {
        position: relative;
        flex: 0 0 min(260px, 78vw);
        scroll-snap-align: start;
        border-radius: 24px;
        border: 1px solid rgba(0, 154, 223, 0.14);
        background: rgba(255, 255, 255, 0.92);
        box-shadow: 0 18px 44px rgba(9, 70, 138, 0.08);
        overflow: hidden;
        transition: transform 220ms ease, box-shadow 220ms ease, border-color 220ms ease;
      }
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
      .gallery-card-item:hover {
        transform: translateY(-4px);
        border-color: rgba(0, 154, 223, 0.24);
        box-shadow: 0 24px 52px rgba(9, 70, 138, 0.12);
      }
      .gallery-thumb {
        width: 100%;
        aspect-ratio: 4 / 3;
        object-fit: cover;
        border-bottom: 1px solid rgba(15, 23, 42, 0.22);
      }
      .gallery-meta {
        padding: 10px 10px 12px;
      }
      .gallery-meta-title {
        font-size: 0.95rem;
        font-weight: 700;
        color: #1f2937;
        line-height: 1.3;
      }
      .gallery-meta-desc {
        margin-top: 4px;
        font-size: 0.84rem;
        color: #475569;
        line-height: 1.45;
      }
      @media (min-width: 1024px) {
        .gallery-card-item {
          flex-basis: 260px;
        }
      }
    
</style>


      <section class="border-b border-sky-100 bg-[linear-gradient(135deg,_rgba(236,248,255,0.96),_rgba(255,255,255,0.98)_42%,_rgba(127,215,255,0.22)_100%)] py-14 lg:py-20">
        <div class="mx-auto max-w-7xl px-4">
          <p class="text-sm font-medium text-slate-500"><a href="{{ route('home') }}" class="hover:text-brand-blue">Home</a> / Client / Portfolio</p>
          <h1 class="mt-5 max-w-4xl text-[2.15rem] font-black leading-[1.05] text-brand-blue sm:text-[2.8rem] lg:text-[3.5rem]">{{ $page?->hero_title ?? 'Client showcase and training gallery aligned with the website draft structure.' }}</h1>
          <div class="mt-8 grid max-w-3xl gap-4 sm:grid-cols-2">
            <div class="rounded-[24px] border border-brand-blue/15 bg-white/92 px-5 py-5 shadow-soft">
              <p class="text-xs font-semibold uppercase tracking-[0.18em] text-slate-500">Presentation Use</p>
              <p class=" text-lg font-black leading-snug mt-4 text-brand-navy">Client logos and curated documentation for trust-building presentation.</p>
            </div>
            <div class="rounded-[24px] border border-brand-blue/15 bg-brand-sky/90 px-5 py-5 shadow-soft">
              <p class="text-xs font-semibold uppercase tracking-[0.18em] text-slate-500">Content Structure</p>
              <p class=" text-lg font-black leading-snug mt-4 text-brand-navy">Separated into client showcase and year-based training activity gallery.</p>
            </div>
          </div>
        </div>
      </section>

      <section class="bg-transparent py-14 lg:py-18">
        <div class="mx-auto max-w-7xl px-4">
          <div class="flex items-end justify-between gap-4">
            <div>
              <p class="text-sm font-bold uppercase tracking-[0.22em] text-brand-blue">Our Clients</p>
              
            </div>
          </div>
          <div class="mt-8 rounded-[30px] border border-brand-blue/14 bg-transparent p-4 shadow-none sm:p-5 lg:p-6">
            <div id="clients-carousel" class="clients-carousel cursor-grab active:cursor-grabbing">
              
            </div>
            <div id="clients-dots" class="clients-dots mt-6" aria-label="Clients carousel pagination"></div>
          </div>
        </div>
      </section>

      <section class="bg-transparent py-14 lg:py-20">
        <div class="mx-auto max-w-7xl px-4">
          <h2 class="text-3xl font-black text-brand-blue">Per year training documentation showcases</h2>

          <div class="gallery-year-block mt-8">
            <div class="gallery-year-head">
              <h3 class="text-2xl font-bold text-slate-800">Tahun 2026</h3>
              <div class="gallery-controls hidden lg:inline-flex">
                <button type="button" class="gallery-control-btn" data-dir="prev" aria-label="Geser galeri 2026 ke kiri">‹</button>
                <button type="button" class="gallery-control-btn" data-dir="next" aria-label="Geser galeri 2026 ke kanan">›</button>
              </div>
            </div>
            <div class="gallery-track mt-4" data-gallery-track>
              <article class="gallery-card-item">
                <img class="gallery-thumb" src="/template/Logo/assets/Dokumentasi Training/01 Training Refreshment Cyber Bootcamp_Otoritas Jasa Keuangan_tgl 14 April 2026.jpeg" alt="Dokumentasi 2026 - Program 1" loading="lazy" />
                <div class="gallery-meta">
                  <p class="gallery-meta-title">Security Awareness Bootcamp</p>
                  <p class="gallery-meta-desc">Training intensif awareness dan praktik mitigasi risiko keamanan.</p>
                </div>
              </article>
              <article class="gallery-card-item">
                <img class="gallery-thumb" src="/template/Logo/assets/Dokumentasi Training/02 CISSP tgl 10 April 2026_PT.Kereta Api Indonesia_PT. Bussan Auto Finance_PT. Pegadaian.jpeg" alt="Dokumentasi 2026 - Program 2" loading="lazy" />
                <div class="gallery-meta">
                  <p class="gallery-meta-title">Cyber Connect Workshop</p>
                  <p class="gallery-meta-desc">Kolaborasi tim lintas divisi untuk latihan incident response.</p>
                </div>
              </article>
              <article class="gallery-card-item">
                <img class="gallery-thumb" src="/template/Logo/assets/Dokumentasi Training/03 CompTIA Sec+ tgl 13 -17 April 2026_PT. Muara Alam Sejahtera_PT. Antang Gunung Meratus.jpeg" alt="Dokumentasi 2026 - Program 3" loading="lazy" />
                <div class="gallery-meta">
                  <p class="gallery-meta-title">Digital Capability Session</p>
                  <p class="gallery-meta-desc">Kelas peningkatan kompetensi digital untuk tim operasional.</p>
                </div>
              </article>
              <article class="gallery-card-item">
                <img class="gallery-thumb" src="/template/Logo/assets/Dokumentasi Training/01 Training Refreshment Cyber Bootcamp_Otoritas Jasa Keuangan_tgl 14 April 2026.jpeg" alt="Dokumentasi 2026 - Program 4" loading="lazy" />
                <div class="gallery-meta">
                  <p class="gallery-meta-title">Executive Briefing Program</p>
                  <p class="gallery-meta-desc">Sesi strategis untuk alignment kebutuhan bisnis dan teknologi.</p>
                </div>
              </article>
              <article class="gallery-card-item">
                <img class="gallery-thumb" src="/template/Logo/assets/Dokumentasi Training/03 CompTIA Sec+ tgl 13 -17 April 2026_PT. Muara Alam Sejahtera_PT. Antang Gunung Meratus.jpeg" alt="Dokumentasi 2026 - Program 5" loading="lazy" />
                <div class="gallery-meta">
                  <p class="gallery-meta-title">Cloud Readiness Class</p>
                  <p class="gallery-meta-desc">Pembekalan tim untuk adopsi cloud yang terukur dan aman.</p>
                </div>
              </article>
              <article class="gallery-card-item">
                <img class="gallery-thumb" src="/template/Logo/assets/Dokumentasi Training/02 CISSP tgl 10 April 2026_PT.Kereta Api Indonesia_PT. Bussan Auto Finance_PT. Pegadaian.jpeg" alt="Dokumentasi 2026 - Program 6" loading="lazy" />
                <div class="gallery-meta">
                  <p class="gallery-meta-title">Blue Team Workshop</p>
                  <p class="gallery-meta-desc">Latihan deteksi dan respon ancaman pada lingkungan enterprise.</p>
                </div>
              </article>
              <article class="gallery-card-item">
                <img class="gallery-thumb" src="/template/Logo/assets/Dokumentasi Training/01 Training Refreshment Cyber Bootcamp_Otoritas Jasa Keuangan_tgl 14 April 2026.jpeg" alt="Dokumentasi 2026 - Program 7" loading="lazy" />
                <div class="gallery-meta">
                  <p class="gallery-meta-title">IT Leadership Series</p>
                  <p class="gallery-meta-desc">Program penguatan peran pemimpin teknologi di level manajerial.</p>
                </div>
              </article>
              <article class="gallery-card-item">
                <img class="gallery-thumb" src="/template/Logo/assets/Dokumentasi Training/03 CompTIA Sec+ tgl 13 -17 April 2026_PT. Muara Alam Sejahtera_PT. Antang Gunung Meratus.jpeg" alt="Dokumentasi 2026 - Program 8" loading="lazy" />
                <div class="gallery-meta">
                  <p class="gallery-meta-title">Data Governance Essentials</p>
                  <p class="gallery-meta-desc">Praktik tata kelola data untuk kualitas dan kepatuhan bisnis.</p>
                </div>
              </article>
              <article class="gallery-card-item">
                <img class="gallery-thumb" src="/template/Logo/assets/Dokumentasi Training/02 CISSP tgl 10 April 2026_PT.Kereta Api Indonesia_PT. Bussan Auto Finance_PT. Pegadaian.jpeg" alt="Dokumentasi 2026 - Program 9" loading="lazy" />
                <div class="gallery-meta">
                  <p class="gallery-meta-title">Incident Drill Session</p>
                  <p class="gallery-meta-desc">Skenario drill lintas tim untuk percepatan incident handling.</p>
                </div>
              </article>
              <article class="gallery-card-item">
                <img class="gallery-thumb" src="/template/Logo/assets/Dokumentasi Training/01 Training Refreshment Cyber Bootcamp_Otoritas Jasa Keuangan_tgl 14 April 2026.jpeg" alt="Dokumentasi 2026 - Program 10" loading="lazy" />
                <div class="gallery-meta">
                  <p class="gallery-meta-title">Enterprise Security Review</p>
                  <p class="gallery-meta-desc">Evaluasi kontrol keamanan untuk peningkatan maturity organisasi.</p>
                </div>
              </article>
            </div>
          </div>

          <div class="gallery-year-block">
            <div class="gallery-year-head">
              <h3 class="text-2xl font-bold text-slate-800">Tahun 2025</h3>
              <div class="gallery-controls hidden lg:inline-flex">
                <button type="button" class="gallery-control-btn" data-dir="prev" aria-label="Geser galeri 2025 ke kiri">‹</button>
                <button type="button" class="gallery-control-btn" data-dir="next" aria-label="Geser galeri 2025 ke kanan">›</button>
              </div>
            </div>
            <div class="gallery-track mt-4" data-gallery-track>
              <article class="gallery-card-item">
                <img class="gallery-thumb" src="/template/Logo/assets/Dokumentasi Training/02 CISSP tgl 10 April 2026_PT.Kereta Api Indonesia_PT. Bussan Auto Finance_PT. Pegadaian.jpeg" alt="Dokumentasi 2025 - Program 1" loading="lazy" />
                <div class="gallery-meta">
                  <p class="gallery-meta-title">Cybersecurity Awareness Training</p>
                  <p class="gallery-meta-desc">Program awareness untuk memperkuat budaya keamanan informasi.</p>
                </div>
              </article>
              <article class="gallery-card-item">
                <img class="gallery-thumb" src="/template/Logo/assets/Dokumentasi Training/03 CompTIA Sec+ tgl 13 -17 April 2026_PT. Muara Alam Sejahtera_PT. Antang Gunung Meratus.jpeg" alt="Dokumentasi 2025 - Program 2" loading="lazy" />
                <div class="gallery-meta">
                  <p class="gallery-meta-title">Data Literacy Essentials</p>
                  <p class="gallery-meta-desc">Pelatihan fondasi data untuk pengambilan keputusan berbasis insight.</p>
                </div>
              </article>
              <article class="gallery-card-item">
                <img class="gallery-thumb" src="/template/Logo/assets/Dokumentasi Training/01 Training Refreshment Cyber Bootcamp_Otoritas Jasa Keuangan_tgl 14 April 2026.jpeg" alt="Dokumentasi 2025 - Program 3" loading="lazy" />
                <div class="gallery-meta">
                  <p class="gallery-meta-title">In-house IT Governance</p>
                  <p class="gallery-meta-desc">Penyelarasan tata kelola TI dengan prioritas bisnis perusahaan.</p>
                </div>
              </article>
              <article class="gallery-card-item">
                <img class="gallery-thumb" src="/template/Logo/assets/Dokumentasi Training/02 CISSP tgl 10 April 2026_PT.Kereta Api Indonesia_PT. Bussan Auto Finance_PT. Pegadaian.jpeg" alt="Dokumentasi 2025 - Program 4" loading="lazy" />
                <div class="gallery-meta">
                  <p class="gallery-meta-title">Threat Simulation Lab</p>
                  <p class="gallery-meta-desc">Simulasi skenario serangan untuk kesiapan tim teknis dan manajerial.</p>
                </div>
              </article>
              <article class="gallery-card-item">
                <img class="gallery-thumb" src="/template/Logo/assets/Dokumentasi Training/01 Training Refreshment Cyber Bootcamp_Otoritas Jasa Keuangan_tgl 14 April 2026.jpeg" alt="Dokumentasi 2025 - Program 5" loading="lazy" />
                <div class="gallery-meta">
                  <p class="gallery-meta-title">SOC Foundation Class</p>
                  <p class="gallery-meta-desc">Dasar operasional SOC untuk monitoring dan analisis log.</p>
                </div>
              </article>
              <article class="gallery-card-item">
                <img class="gallery-thumb" src="/template/Logo/assets/Dokumentasi Training/03 CompTIA Sec+ tgl 13 -17 April 2026_PT. Muara Alam Sejahtera_PT. Antang Gunung Meratus.jpeg" alt="Dokumentasi 2025 - Program 6" loading="lazy" />
                <div class="gallery-meta">
                  <p class="gallery-meta-title">Secure Coding Practice</p>
                  <p class="gallery-meta-desc">Pelatihan coding aman untuk menurunkan celah kerentanan aplikasi.</p>
                </div>
              </article>
              <article class="gallery-card-item">
                <img class="gallery-thumb" src="/template/Logo/assets/Dokumentasi Training/02 CISSP tgl 10 April 2026_PT.Kereta Api Indonesia_PT. Bussan Auto Finance_PT. Pegadaian.jpeg" alt="Dokumentasi 2025 - Program 7" loading="lazy" />
                <div class="gallery-meta">
                  <p class="gallery-meta-title">Risk Assessment Clinic</p>
                  <p class="gallery-meta-desc">Pendampingan asesmen risiko TI berbasis konteks bisnis.</p>
                </div>
              </article>
              <article class="gallery-card-item">
                <img class="gallery-thumb" src="/template/Logo/assets/Dokumentasi Training/01 Training Refreshment Cyber Bootcamp_Otoritas Jasa Keuangan_tgl 14 April 2026.jpeg" alt="Dokumentasi 2025 - Program 8" loading="lazy" />
                <div class="gallery-meta">
                  <p class="gallery-meta-title">Network Defense Program</p>
                  <p class="gallery-meta-desc">Penguatan defensive control untuk infrastruktur jaringan utama.</p>
                </div>
              </article>
              <article class="gallery-card-item">
                <img class="gallery-thumb" src="/template/Logo/assets/Dokumentasi Training/03 CompTIA Sec+ tgl 13 -17 April 2026_PT. Muara Alam Sejahtera_PT. Antang Gunung Meratus.jpeg" alt="Dokumentasi 2025 - Program 9" loading="lazy" />
                <div class="gallery-meta">
                  <p class="gallery-meta-title">Digital Ops Upskilling</p>
                  <p class="gallery-meta-desc">Peningkatan kompetensi operasional digital bagi tim internal.</p>
                </div>
              </article>
              <article class="gallery-card-item">
                <img class="gallery-thumb" src="/template/Logo/assets/Dokumentasi Training/02 CISSP tgl 10 April 2026_PT.Kereta Api Indonesia_PT. Bussan Auto Finance_PT. Pegadaian.jpeg" alt="Dokumentasi 2025 - Program 10" loading="lazy" />
                <div class="gallery-meta">
                  <p class="gallery-meta-title">Executive Security Forum</p>
                  <p class="gallery-meta-desc">Forum strategis untuk roadmap keamanan dan transformasi digital.</p>
                </div>
              </article>
            </div>
          </div>

          <div class="gallery-year-block">
            <div class="gallery-year-head">
              <h3 class="text-2xl font-bold text-slate-800">Tahun 2024</h3>
              <div class="gallery-controls hidden lg:inline-flex">
                <button type="button" class="gallery-control-btn" data-dir="prev" aria-label="Geser galeri 2024 ke kiri">‹</button>
                <button type="button" class="gallery-control-btn" data-dir="next" aria-label="Geser galeri 2024 ke kanan">›</button>
              </div>
            </div>
            <div class="gallery-track mt-4" data-gallery-track>
              <article class="gallery-card-item">
                <img class="gallery-thumb" src="/template/Logo/assets/Dokumentasi Training/03 CompTIA Sec+ tgl 13 -17 April 2026_PT. Muara Alam Sejahtera_PT. Antang Gunung Meratus.jpeg" alt="Dokumentasi 2024 - Program 1" loading="lazy" />
                <div class="gallery-meta">
                  <p class="gallery-meta-title">Security Connect Program</p>
                  <p class="gallery-meta-desc">Program kolaboratif untuk peningkatan kontrol keamanan enterprise.</p>
                </div>
              </article>
              <article class="gallery-card-item">
                <img class="gallery-thumb" src="/template/Logo/assets/Dokumentasi Training/01 Training Refreshment Cyber Bootcamp_Otoritas Jasa Keuangan_tgl 14 April 2026.jpeg" alt="Dokumentasi 2024 - Program 2" loading="lazy" />
                <div class="gallery-meta">
                  <p class="gallery-meta-title">Practical SOC Session</p>
                  <p class="gallery-meta-desc">Pelatihan praktik monitoring dan handling insiden secara real-time.</p>
                </div>
              </article>
              <article class="gallery-card-item">
                <img class="gallery-thumb" src="/template/Logo/assets/Dokumentasi Training/02 CISSP tgl 10 April 2026_PT.Kereta Api Indonesia_PT. Bussan Auto Finance_PT. Pegadaian.jpeg" alt="Dokumentasi 2024 - Program 3" loading="lazy" />
                <div class="gallery-meta">
                  <p class="gallery-meta-title">IT Risk Management Clinic</p>
                  <p class="gallery-meta-desc">Workshop evaluasi risiko TI dan penyusunan rencana mitigasi.</p>
                </div>
              </article>
              <article class="gallery-card-item">
                <img class="gallery-thumb" src="/template/Logo/assets/Dokumentasi Training/03 CompTIA Sec+ tgl 13 -17 April 2026_PT. Muara Alam Sejahtera_PT. Antang Gunung Meratus.jpeg" alt="Dokumentasi 2024 - Program 4" loading="lazy" />
                <div class="gallery-meta">
                  <p class="gallery-meta-title">Digital Transformation Forum</p>
                  <p class="gallery-meta-desc">Sesi diskusi strategi transformasi digital lintas unit bisnis.</p>
                </div>
              </article>
              <article class="gallery-card-item">
                <img class="gallery-thumb" src="/template/Logo/assets/Dokumentasi Training/01 Training Refreshment Cyber Bootcamp_Otoritas Jasa Keuangan_tgl 14 April 2026.jpeg" alt="Dokumentasi 2024 - Program 5" loading="lazy" />
                <div class="gallery-meta">
                  <p class="gallery-meta-title">Security Baseline Training</p>
                  <p class="gallery-meta-desc">Penguatan baseline kontrol keamanan untuk seluruh unit kerja.</p>
                </div>
              </article>
              <article class="gallery-card-item">
                <img class="gallery-thumb" src="/template/Logo/assets/Dokumentasi Training/02 CISSP tgl 10 April 2026_PT.Kereta Api Indonesia_PT. Bussan Auto Finance_PT. Pegadaian.jpeg" alt="Dokumentasi 2024 - Program 6" loading="lazy" />
                <div class="gallery-meta">
                  <p class="gallery-meta-title">Cyber Risk Workshop</p>
                  <p class="gallery-meta-desc">Workshop identifikasi risiko siber dan perencanaan mitigasi.</p>
                </div>
              </article>
              <article class="gallery-card-item">
                <img class="gallery-thumb" src="/template/Logo/assets/Dokumentasi Training/03 CompTIA Sec+ tgl 13 -17 April 2026_PT. Muara Alam Sejahtera_PT. Antang Gunung Meratus.jpeg" alt="Dokumentasi 2024 - Program 7" loading="lazy" />
                <div class="gallery-meta">
                  <p class="gallery-meta-title">Operational Resilience Class</p>
                  <p class="gallery-meta-desc">Kesiapan operasional menghadapi gangguan sistem dan proses.</p>
                </div>
              </article>
              <article class="gallery-card-item">
                <img class="gallery-thumb" src="/template/Logo/assets/Dokumentasi Training/01 Training Refreshment Cyber Bootcamp_Otoritas Jasa Keuangan_tgl 14 April 2026.jpeg" alt="Dokumentasi 2024 - Program 8" loading="lazy" />
                <div class="gallery-meta">
                  <p class="gallery-meta-title">Governance Improvement Session</p>
                  <p class="gallery-meta-desc">Sesi peningkatan framework governance untuk tim TI perusahaan.</p>
                </div>
              </article>
              <article class="gallery-card-item">
                <img class="gallery-thumb" src="/template/Logo/assets/Dokumentasi Training/02 CISSP tgl 10 April 2026_PT.Kereta Api Indonesia_PT. Bussan Auto Finance_PT. Pegadaian.jpeg" alt="Dokumentasi 2024 - Program 9" loading="lazy" />
                <div class="gallery-meta">
                  <p class="gallery-meta-title">Practical Compliance Lab</p>
                  <p class="gallery-meta-desc">Latihan implementasi kontrol kepatuhan yang aplikatif.</p>
                </div>
              </article>
              <article class="gallery-card-item">
                <img class="gallery-thumb" src="/template/Logo/assets/Dokumentasi Training/03 CompTIA Sec+ tgl 13 -17 April 2026_PT. Muara Alam Sejahtera_PT. Antang Gunung Meratus.jpeg" alt="Dokumentasi 2024 - Program 10" loading="lazy" />
                <div class="gallery-meta">
                  <p class="gallery-meta-title">Technology Roadmap Clinic</p>
                  <p class="gallery-meta-desc">Pendampingan penyusunan roadmap teknologi jangka menengah.</p>
                </div>
              </article>
            </div>
          </div>
        </div>
      </section>
    
@endsection
