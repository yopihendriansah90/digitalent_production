@extends('layouts.app')

@section('content')
@php
  $contactContent = $contactContent ?? null;
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

  $contactInfoBlock = $sections['contact_info'] ?? null;
  $contactInfoItems = collect($contactContent->contact_items ?? []);
  $serviceOptions = collect($contactContent->service_options ?? []);

  $heroTitle = $contactContent ? $trans($contactContent->hero_title) : ($page?->hero_title ?? 'Contact DigiTalent for training plans, talent needs, and partnership discussion.');
  $contactTitle = $contactContent ? $trans($contactContent->contact_info_title) : ($contactInfoBlock?->section_title ?: 'Contact Information');
  $formTitle = $contactContent ? $trans($contactContent->form_title) : 'Contact Form';

  $formLabels = $contactContent->form_labels ?? [];
  $buttonLabels = $contactContent->button_labels ?? [];

  $nameLabel = $trans(data_get($formLabels, 'name'), 'Nama');
  $namePlaceholder = $trans(data_get($formLabels, 'name_placeholder'), 'Nama lengkap');
  $emailLabel = $trans(data_get($formLabels, 'email'), 'Email');
  $emailPlaceholder = $trans(data_get($formLabels, 'email_placeholder'), 'email@company.com');
  $serviceTypeLabel = $trans(data_get($formLabels, 'service_type'), 'Jenis Services');
  $serviceTypePlaceholder = $trans(data_get($formLabels, 'service_placeholder'), 'Pilih layanan');
  $messageLabel = $trans(data_get($formLabels, 'message'), 'Pertanyaan');
  $messagePlaceholder = $trans(data_get($formLabels, 'message_placeholder'), 'Jelaskan kebutuhan Anda');

  $submitLabel = $trans(data_get($buttonLabels, 'submit'), 'Kirim Pertanyaan');
  $successMessage = $trans(data_get($buttonLabels, 'success'), 'Pesan Anda sudah terkirim. Tim kami akan segera menghubungi Anda.');
  $errorMessage = $trans(data_get($buttonLabels, 'error'), 'Mohon cek kembali input form Anda.');
@endphp
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
    <h1 class="mt-5 max-w-4xl text-[2.15rem] font-black leading-[1.05] text-brand-blue sm:text-[2.8rem] lg:text-[3.5rem]">{{ $heroTitle }}</h1>
  </div>
</section>

<section class="bg-[linear-gradient(180deg,_rgba(255,255,255,0.94),_rgba(236,248,255,0.5))] py-14 lg:py-20">
  <div class="mx-auto grid max-w-7xl gap-8 px-4 lg:grid-cols-[0.9fr_1.1fr]">
    <div class="space-y-5">
      <div class="panel-card rounded-[28px] p-6 pt-8">
        <h2 class="text-2xl font-black text-brand-blue">{{ $contactTitle }}</h2>
        @if ($contactInfoItems->isNotEmpty())
          <div class="mt-5 space-y-4 leading-7 text-slate-600">
            @foreach ($contactInfoItems as $item)
              <p>
                <strong class="text-brand-navy">{{ $trans(data_get($item, 'label')) }}:</strong>
                @if (filled(data_get($item, 'link')))
                  <a class="text-brand-blue hover:text-brand-navy" href="{{ data_get($item, 'link') }}" target="_blank" rel="noopener noreferrer">{{ $trans(data_get($item, 'value')) }}</a>
                @else
                  {{ $trans(data_get($item, 'value')) }}
                @endif
              </p>
            @endforeach
          </div>
        @elseif ($contactInfoBlock?->items?->isNotEmpty())
          <div class="mt-5 space-y-4 leading-7 text-slate-600">
            @foreach ($contactInfoBlock->items as $item)
              <p><strong class="text-brand-navy">{{ $item->title }}:</strong> {{ $item->description }}</p>
            @endforeach
          </div>
        @else
          <div class="mt-5 space-y-4 leading-7 text-slate-600">
            <p><strong class="text-brand-navy">Phone:</strong> {{ $siteSetting->phone ?? '(+62) 21 522 4520' }}</p>
            <p><strong class="text-brand-navy">Email:</strong> {{ $siteSetting->email ?? 'info@digitalent.co.id' }}</p>
            <p><strong class="text-brand-navy">Website:</strong> {{ $siteSetting->website_url ?? 'www.digitalent.co.id' }}</p>
            <p><strong class="text-brand-navy">Address:</strong> {{ $siteSetting->address ?? 'Wisma Bumiputera Lantai 1, Jl. Jend. Sudirman Kav. 75 Jakarta Selatan 12910 Indonesia' }}</p>
          </div>
        @endif
      </div>
    </div>

    <form class="panel-card rounded-[30px] p-7 pt-8" method="POST" action="{{ route('contact.submit') }}">
      @csrf
      <input type="text" name="website" tabindex="-1" autocomplete="off" class="hidden" aria-hidden="true" />
      <h2 class="text-2xl font-black text-brand-blue">{{ $formTitle }}</h2>
      @if (session('success'))
        <p class="mt-4 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">{{ $successMessage }}</p>
      @endif
      @if ($errors->any())
        <p class="mt-4 rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700">{{ $errorMessage }}</p>
      @endif
      <div class="mt-6 grid gap-4 md:grid-cols-2">
        <label class="block">
          <span class="text-sm font-bold text-slate-700">{{ $nameLabel }}</span>
          <input class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 outline-none focus:border-brand-blue" name="name" type="text" value="{{ old('name') }}" placeholder="{{ $namePlaceholder }}" />
        </label>
        <label class="block">
          <span class="text-sm font-bold text-slate-700">{{ $emailLabel }}</span>
          <input class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 outline-none focus:border-brand-blue" name="email" type="email" value="{{ old('email') }}" placeholder="{{ $emailPlaceholder }}" />
        </label>
        <label class="block md:col-span-2">
          <span class="text-sm font-bold text-slate-700">{{ $serviceTypeLabel }}</span>
          <select class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 outline-none focus:border-brand-blue" name="service_type">
            <option value="">{{ $serviceTypePlaceholder }}</option>
            @if ($serviceOptions->isNotEmpty())
              @foreach ($serviceOptions as $option)
                @php($optionText = $trans($option))
                <option value="{{ $optionText }}" @selected(old('service_type') === $optionText)>{{ $optionText }}</option>
              @endforeach
            @else
              <option @selected(old('service_type') === 'IT Training')>IT Training</option>
              <option @selected(old('service_type') === 'IT Outsourcing')>IT Outsourcing</option>
              <option @selected(old('service_type') === 'Corporate In-House Training')>Corporate In-House Training</option>
              <option @selected(old('service_type') === 'ODP (Office Development Program)')>ODP (Office Development Program)</option>
              <option @selected(old('service_type') === 'Partnership')>Partnership</option>
            @endif
          </select>
        </label>
        <label class="block md:col-span-2">
          <span class="text-sm font-bold text-slate-700">{{ $messageLabel }}</span>
          <textarea class="mt-2 h-36 w-full rounded-xl border border-slate-300 px-4 py-3 outline-none focus:border-brand-blue" name="message" placeholder="{{ $messagePlaceholder }}">{{ old('message') }}</textarea>
        </label>
      </div>
      <button class="mt-6 inline-flex rounded-full bg-brand-orange px-6 py-3.5 font-bold text-brand-navy hover:bg-brand-navy hover:text-white" type="submit">{{ $submitLabel }}</button>
    </form>
  </div>
</section>
@endsection
