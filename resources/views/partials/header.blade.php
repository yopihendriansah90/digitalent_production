@php
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

    $nav = [
        ['route' => 'home', 'key' => 'home', 'fallback' => ['id' => 'Home', 'en' => 'Home']],
        ['route' => 'about', 'key' => 'about', 'fallback' => ['id' => 'Tentang Kami', 'en' => 'About Us']],
        ['route' => 'services', 'key' => 'services', 'fallback' => ['id' => 'Layanan', 'en' => 'Services']],
        ['route' => 'vision-mission', 'key' => 'vision_mission', 'fallback' => ['id' => 'Visi & Misi', 'en' => 'Vision & Mission']],
        ['route' => 'portfolio', 'key' => 'portfolio', 'fallback' => ['id' => 'Klien / Portofolio', 'en' => 'Client / Portfolio']],
        ['route' => 'training', 'key' => 'training', 'fallback' => ['id' => 'Training', 'en' => 'Training']],
        ['route' => 'outsourcing', 'key' => 'outsourcing', 'fallback' => ['id' => 'Outsourcing', 'en' => 'Outsourcing']],
        ['route' => 'contact', 'key' => 'contact', 'fallback' => ['id' => 'Kontak', 'en' => 'Contact']],
    ];

    $langQuery = in_array($activeLocale, ['id', 'en'], true) ? ['lang' => $activeLocale] : [];
    $routeWithLang = fn (string $route): string => route($route, $langQuery);
    $switchToIdUrl = request()->fullUrlWithQuery(['lang' => 'id']);
    $switchToEnUrl = request()->fullUrlWithQuery(['lang' => 'en']);

    $logoLight = $siteSetting?->getFirstMediaUrl('logo_light') ?: '/template/Logo/PNG/Horizontal_Background Terang.png';
    $topbarWorkingHours = $trans($siteSetting?->topbar_working_hours, 'Monday - Friday, 08:00 - 17:00 WIB');
    $topbarAddressShort = $trans($siteSetting?->topbar_address_short, 'Wisma Bumiputera Lt. 1, Jl. Jend. Sudirman Kav. 75');
    $consultationLabel = $trans($siteSetting?->consultation_label, 'Free Consultation');
@endphp

<div class="fixed inset-x-0 top-0 z-50">
    <div id="desktop-topbar" class="hidden max-h-0 overflow-hidden bg-[linear-gradient(135deg,_#009adf,_#18aceb_52%,_#7fd7ff_100%)] text-white opacity-0 transition-[max-height,opacity] duration-300 ease-out lg:block lg:max-h-[52px] lg:opacity-100">
        <div class="mx-auto flex max-w-7xl flex-col gap-2 px-4 py-3 text-sm md:flex-row md:items-center md:justify-between">
            <div class="flex flex-wrap gap-x-6 gap-y-2 text-white/85">
                <span>{{ $topbarWorkingHours }}</span>
                <span>{{ $topbarAddressShort ?: ($siteSetting->address ?? 'Wisma Bumiputera Lt. 1, Jl. Jend. Sudirman Kav. 75') }}</span>
            </div>
            <div class="flex items-center gap-4">
                <a class="text-white/85 hover:text-brand-cyan" href="mailto:{{ $siteSetting->email ?? 'info@digitalent.co.id' }}">{{ $siteSetting->email ?? 'info@digitalent.co.id' }}</a>
            </div>
        </div>
    </div>

    <header class="border-b border-brand-blue/20 bg-[linear-gradient(180deg,_rgba(255,255,255,0.94),_rgba(236,248,255,0.96))] backdrop-blur">
        <nav class="mx-auto flex max-w-7xl items-center justify-between gap-4 px-4 py-4 lg:py-5">
            <a href="{{ $routeWithLang('home') }}"><img src="{{ $logoLight }}" alt="DigiTalent" class="h-10 w-auto sm:h-11 lg:h-12" /></a>
            <button id="mobile-menu-toggle" class="inline-flex h-11 w-11 items-center justify-center rounded-xl border border-brand-blue/15 bg-brand-sky/70 text-brand-navy lg:hidden" type="button" aria-expanded="false" aria-controls="mobile-drawer" aria-label="Open navigation menu">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                    <path d="M4 7h16"></path>
                    <path d="M4 12h16"></path>
                    <path d="M4 17h16"></path>
                </svg>
            </button>

            <div class="hidden items-center gap-x-6 gap-y-3 text-sm font-bold lg:flex">
                @foreach ($nav as $item)
                    <a class="{{ request()->routeIs($item['route']) ? 'text-brand-blue' : 'text-slate-700 transition hover:text-brand-blue' }}" href="{{ $routeWithLang($item['route']) }}">{{ $trans(data_get($siteSetting?->nav_labels, $item['key']), $trans($item['fallback'])) }}</a>
                @endforeach
                <div class="ml-1 inline-flex items-center rounded-full border border-brand-blue/20 bg-white/90 p-1 text-xs font-bold">
                    <a href="{{ $switchToIdUrl }}" class="rounded-full px-3 py-1 {{ $activeLocale === 'id' ? 'bg-brand-blue text-white' : 'text-brand-navy hover:bg-brand-sky' }}">ID</a>
                    <a href="{{ $switchToEnUrl }}" class="rounded-full px-3 py-1 {{ $activeLocale === 'en' ? 'bg-brand-blue text-white' : 'text-brand-navy hover:bg-brand-sky' }}">EN</a>
                </div>
                <a class="rounded-full bg-brand-blue px-5 py-3 text-white shadow-[0_12px_28px_rgba(0,154,223,0.22)] transition hover:bg-brand-navy hover:text-white" href="{{ $routeWithLang('contact') }}">{{ $consultationLabel }}</a>
            </div>
        </nav>
    </header>
</div>

<div id="header-spacer" class="h-[76px] lg:h-[128px] transition-[height] duration-300 ease-out" aria-hidden="true"></div>

<div id="mobile-drawer" class="pointer-events-none fixed inset-0 z-[70] lg:hidden" aria-hidden="true">
    <div id="mobile-drawer-backdrop" class="absolute inset-0 bg-brand-blue/35 opacity-0 transition-opacity duration-200"></div>
    <aside id="mobile-drawer-panel" class="absolute right-0 top-0 h-full w-[84vw] max-w-[360px] translate-x-full bg-[linear-gradient(180deg,_#ffffff,_#ecf8ff)] shadow-2xl transition-transform duration-300">
        <div class="flex items-center justify-between border-b border-brand-blue/10 px-5 py-4">
            <img src="{{ $logoLight }}" alt="DigiTalent" class="h-9 w-auto" />
            <button id="mobile-menu-close" class="inline-flex h-10 w-10 items-center justify-center rounded-xl border border-brand-blue/15 bg-white text-brand-navy" type="button" aria-label="Close navigation menu">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                    <path d="M6 6l12 12"></path>
                    <path d="M18 6L6 18"></path>
                </svg>
            </button>
        </div>
        <div class="flex h-[calc(100%-73px)] flex-col overflow-y-auto px-5 py-5">
            <div class="mb-5 inline-flex w-fit items-center rounded-full border border-brand-blue/20 bg-white p-1 text-xs font-bold">
                <a href="{{ $switchToIdUrl }}" class="rounded-full px-3 py-1 {{ $activeLocale === 'id' ? 'bg-brand-blue text-white' : 'text-brand-navy hover:bg-brand-sky' }}">ID</a>
                <a href="{{ $switchToEnUrl }}" class="rounded-full px-3 py-1 {{ $activeLocale === 'en' ? 'bg-brand-blue text-white' : 'text-brand-navy hover:bg-brand-sky' }}">EN</a>
            </div>
            <div class="grid gap-4 text-[1.05rem] font-semibold">
                @foreach ($nav as $item)
                    <a class="{{ request()->routeIs($item['route']) ? 'text-brand-blue' : 'text-slate-700 transition hover:text-brand-blue' }}" href="{{ $routeWithLang($item['route']) }}">{{ $trans(data_get($siteSetting?->nav_labels, $item['key']), $trans($item['fallback'])) }}</a>
                @endforeach
            </div>
            <a class="mt-6 inline-flex w-full items-center justify-center rounded-full bg-brand-blue px-5 py-3.5 font-bold text-white shadow-[0_12px_28px_rgba(0,154,223,0.22)]" href="{{ $routeWithLang('contact') }}">{{ $consultationLabel }}</a>
        </div>
    </aside>
</div>
