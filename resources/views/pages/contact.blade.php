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
    
</style>


      <section class="border-b border-sky-100 bg-[linear-gradient(135deg,_rgba(236,248,255,0.96),_rgba(255,255,255,0.98)_42%,_rgba(127,215,255,0.22)_100%)] py-14 lg:py-20">
        <div class="mx-auto max-w-7xl px-4">
          <p class="text-sm font-medium text-slate-500"><a href="{{ route('home') }}" class="hover:text-brand-blue">Home</a> / Contact</p>
          <h1 class="mt-5 max-w-4xl text-[2.15rem] font-black leading-[1.05] text-brand-blue sm:text-[2.8rem] lg:text-[3.5rem]">Contact DigiTalent for training plans, talent needs, and partnership discussion.</h1>
        </div>
      </section>

      <section class="bg-[linear-gradient(180deg,_rgba(255,255,255,0.94),_rgba(236,248,255,0.5))] py-14 lg:py-20">
        <div class="mx-auto grid max-w-7xl gap-8 px-4 lg:grid-cols-[0.9fr_1.1fr]">
          <div class="space-y-5">
            <div class="panel-card rounded-[28px] p-6 pt-8">
              <h2 class="text-2xl font-black text-brand-blue">Contact Information</h2>
              <div class="mt-5 space-y-4 leading-7 text-slate-600">
                <p><strong class="text-brand-navy">Phone:</strong> (+62) 21 522 4520</p>
                <p><strong class="text-brand-navy">Email:</strong> info@digitalent.co.id</p>
                <p><strong class="text-brand-navy">Website:</strong> www.digitalent.co.id</p>
                <p><strong class="text-brand-navy">Address:</strong> Wisma Bumiputera Lantai 1, Jl. Jend. Sudirman Kav. 75 Jakarta Selatan 12910 Indonesia</p>
                <p><strong class="text-brand-navy">WhatsApp:</strong> <a class="text-brand-blue hover:text-brand-navy" href="https://wa.me/628131337687">+62 813 1337 687</a></p>
                <p><strong class="text-brand-navy">Instagram:</strong> <a class="text-brand-blue hover:text-brand-navy" href="https://www.instagram.com/digitalent.systech">digitalent.systech</a></p>
                <p><strong class="text-brand-navy">LinkedIn:</strong> <a class="text-brand-blue hover:text-brand-navy" href="https://www.linkedin.com/company/pt-systech-talenta-digital-digitalent">PT Systech Talenta Digital</a></p>
              </div>
            </div>

          </div>

          <form class="panel-card rounded-[30px] p-7 pt-8">
            <h2 class="text-2xl font-black text-brand-blue">Contact Form</h2>
            <div class="mt-6 grid gap-4 md:grid-cols-2">
              <label class="block">
                <span class="text-sm font-bold text-slate-700">Nama</span>
                <input class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 outline-none focus:border-brand-blue" type="text" placeholder="Nama lengkap" />
              </label>
              <label class="block">
                <span class="text-sm font-bold text-slate-700">Email</span>
                <input class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 outline-none focus:border-brand-blue" type="email" placeholder="email@company.com" />
              </label>
              <label class="block md:col-span-2">
                <span class="text-sm font-bold text-slate-700">Jenis Services</span>
                <select class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 outline-none focus:border-brand-blue">
                  <option>IT Training</option>
                  <option>IT Outsourcing</option>
                  <option>Corporate In-House Training</option>
                  <option>ODP (Office Development Program)</option>
                  <option>Partnership</option>
                </select>
              </label>
              <label class="block md:col-span-2">
                <span class="text-sm font-bold text-slate-700">Pertanyaan</span>
                <textarea class="mt-2 h-36 w-full rounded-xl border border-slate-300 px-4 py-3 outline-none focus:border-brand-blue" placeholder="Jelaskan kebutuhan Anda"></textarea>
              </label>
            </div>
            <button class="mt-6 inline-flex rounded-full bg-brand-orange px-6 py-3.5 font-bold text-brand-navy hover:bg-brand-navy hover:text-white" type="button">Kirim Pertanyaan</button>
          </form>
        </div>
      </section>
    
@endsection
