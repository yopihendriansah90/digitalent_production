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

    $langQuery = ['lang' => $activeLocale];
    $routeWithLang = fn (string $route): string => route($route, $langQuery);

    $logoDark = $siteSetting?->getFirstMediaUrl('logo_dark') ?: '/template/Logo/PNG/Horizontal_Background Gelap.png';
    $footerDescription = $trans($siteSetting?->footer_description, 'DigiTalent supports digital transformation through capable, industry-ready talent with a focus on IT Training and IT Outsourcing.');
    $pagesTitle = $trans($siteSetting?->footer_pages_title, 'Pages');
    $servicesTitle = $trans($siteSetting?->footer_services_title, 'Services');
    $contactTitle = $trans($siteSetting?->footer_contact_title, 'Contact');
    $footerBottomRight = $trans($siteSetting?->footer_bottom_right_text, 'Empowering Digital Talent, Enabling Global Success.');
    $whatsappIcon = $siteSetting?->getFirstMediaUrl('whatsapp_icon') ?: asset('template/Logo/whatsapp.png');

    $footerPages = [
        ['route' => 'home', 'label' => $trans(data_get($siteSetting?->nav_labels, 'home'), $activeLocale === 'en' ? 'Home' : 'Home')],
        ['route' => 'about', 'label' => $trans(data_get($siteSetting?->nav_labels, 'about'), $activeLocale === 'en' ? 'About Us' : 'Tentang Kami')],
        ['route' => 'services', 'label' => $trans(data_get($siteSetting?->nav_labels, 'services'), $activeLocale === 'en' ? 'Services' : 'Layanan')],
        ['route' => 'vision-mission', 'label' => $trans(data_get($siteSetting?->nav_labels, 'vision_mission'), $activeLocale === 'en' ? 'Vision & Mission' : 'Visi & Misi')],
        ['route' => 'portfolio', 'label' => $trans(data_get($siteSetting?->nav_labels, 'portfolio'), $activeLocale === 'en' ? 'Client / Portfolio' : 'Klien / Portofolio')],
        ['route' => 'training', 'label' => $trans(data_get($siteSetting?->nav_labels, 'training'), 'Training')],
        ['route' => 'outsourcing', 'label' => $trans(data_get($siteSetting?->nav_labels, 'outsourcing'), 'Outsourcing')],
        ['route' => 'contact', 'label' => $trans(data_get($siteSetting?->nav_labels, 'contact'), $activeLocale === 'en' ? 'Contact' : 'Kontak')],
    ];

    $footerServiceLinks = collect($siteSetting?->footer_service_links ?? [
        ['id' => 'IT Training', 'en' => 'IT Training', 'route' => 'training'],
        ['id' => 'Persiapan Sertifikasi', 'en' => 'Certification Preparation', 'route' => 'training'],
        ['id' => 'Corporate In-House Training', 'en' => 'Corporate In-House Training', 'route' => 'training'],
        ['id' => 'IT Outsourcing', 'en' => 'IT Outsourcing', 'route' => 'outsourcing'],
        ['id' => 'Dedicated IT Staff', 'en' => 'Dedicated IT Staff', 'route' => 'outsourcing'],
        ['id' => 'Project-Based IT Teams', 'en' => 'Project-Based IT Teams', 'route' => 'outsourcing'],
    ]);

    $normalizeIndonesianNumberToDigits = function (?string $value, string $default = '628131337687'): string {
        $raw = trim((string) $value);

        if ($raw === '') {
            return $default;
        }

        if (preg_match('/^https?:\/\//i', $raw)) {
            if (preg_match('#wa\.me/([^/?]+)#i', $raw, $matches)) {
                $raw = urldecode($matches[1]);
            } elseif (preg_match('/[?&]phone=([^&]+)/i', $raw, $matches)) {
                $raw = urldecode($matches[1]);
            }
        }

        $digits = preg_replace('/\D+/', '', $raw) ?? '';

        if ($digits === '') {
            return $default;
        }

        if (str_starts_with($digits, '0')) {
            $digits = '62' . substr($digits, 1);
        } elseif (str_starts_with($digits, '8')) {
            $digits = '62' . $digits;
        } elseif (! str_starts_with($digits, '62')) {
            $digits = '62' . $digits;
        }

        return $digits;
    };

    $phoneDigits = $normalizeIndonesianNumberToDigits($siteSetting?->phone, '62215224520');
    $phoneDisplay = '+' . $phoneDigits;
    $whatsappDigits = $normalizeIndonesianNumberToDigits($siteSetting?->whatsapp, '628131337687');
    $whatsappDisplay = '+' . $whatsappDigits;
@endphp

<style>
    .footer-map-frame iframe {
        width: 100% !important;
        height: 176px !important;
        max-height: 176px !important;
        border: 0 !important;
        display: block;
    }
</style>

<footer class="bg-[linear-gradient(180deg,_#009adf_0%,_#0b7fc4_55%,_#09468a_100%)] text-white">
    <div class="mx-auto grid max-w-7xl gap-10 px-4 py-14 lg:grid-cols-[1.2fr_0.8fr_0.9fr_1fr] lg:gap-12">
        <div>
            <img src="{{ $logoDark }}" alt="DigiTalent" class="h-14 w-auto" />
            <p class="mt-5 max-w-sm text-[1.02rem] leading-8 text-white/84">{{ $footerDescription }}</p>
            @if (filled($siteSetting?->map_embed))
                <div class="footer-map-frame mt-5 max-w-sm overflow-hidden rounded-2xl border border-white/20 bg-white/10 shadow-soft">
                    {!! $siteSetting->map_embed !!}
                </div>
            @endif
        </div>

        <div class="hidden lg:block">
            <h3 class="text-lg font-extrabold text-white">{{ $pagesTitle }}</h3>
            <ul class="mt-4 space-y-3 text-white/82">
                @foreach ($footerPages as $item)
                    <li><a href="{{ $routeWithLang($item['route']) }}" class="transition hover:text-brand-cyan">{{ $item['label'] }}</a></li>
                @endforeach
            </ul>
        </div>

        <div class="hidden lg:block">
            <h3 class="text-lg font-extrabold text-white">{{ $servicesTitle }}</h3>
            <ul class="mt-4 space-y-3 text-white/82">
                @foreach ($footerServiceLinks as $link)
                    @php($targetRoute = data_get($link, 'route', 'services'))
                    <li><a href="{{ $routeWithLang($targetRoute) }}" class="transition hover:text-brand-cyan">{{ $trans($link, data_get($link, 'en')) }}</a></li>
                @endforeach
            </ul>
        </div>

        <div>
            <h3 class="text-lg font-extrabold text-white">{{ $contactTitle }}</h3>
            <ul class="mt-4 space-y-3 text-white/84">
                <li><span class="font-semibold text-white">{{ $activeLocale === 'en' ? 'Phone' : 'Telepon' }}:</span> <a href="tel:{{ $phoneDigits }}" class="transition hover:text-brand-cyan">{{ $phoneDisplay }}</a></li>
                <li><span class="font-semibold text-white">Email:</span> <a href="mailto:{{ $siteSetting?->email ?? 'info@digitalent.co.id' }}" class="transition hover:text-brand-cyan">{{ $siteSetting?->email ?? 'info@digitalent.co.id' }}</a></li>
                <li><span class="font-semibold text-white">Website:</span> <a href="{{ $siteSetting?->website_url ?? 'https://www.digitalent.co.id' }}" class="transition hover:text-brand-cyan">{{ parse_url($siteSetting?->website_url ?? 'https://www.digitalent.co.id', PHP_URL_HOST) ?? 'www.digitalent.co.id' }}</a></li>
                <li><span class="font-semibold text-white">WhatsApp:</span> <a href="https://wa.me/{{ $whatsappDigits }}" class="transition hover:text-brand-cyan">{{ $whatsappDisplay }}</a></li>
                <li class="max-w-[20rem]"><span class="font-semibold text-white">{{ $activeLocale === 'en' ? 'Address' : 'Alamat' }}:</span> {{ $siteSetting?->address ?? 'Wisma Bumiputera Lantai 1, Jl. Jend. Sudirman Kav. 75 Jakarta Selatan 12910 Indonesia' }}</li>
            </ul>
        </div>
    </div>

    <div class="border-t border-white/12">
        <div class="mx-auto flex max-w-7xl flex-col items-center gap-3 px-4 py-6 text-center text-sm text-white/72 md:flex-row md:items-center md:justify-between md:text-left">
            <p>{{ $siteSetting->copyright_text ?? ('© '.date('Y').' DigiTalent. All rights reserved.') }}</p>
            <p>{{ $footerBottomRight }}</p>
        </div>
    </div>
</footer>

@if (! empty($whatsappDigits))
    <a href="https://wa.me/{{ $whatsappDigits }}" class="fixed bottom-5 right-5 z-50 block h-16 w-16 transition hover:scale-105" aria-label="Chat DigiTalent via WhatsApp">
        <img src="{{ $whatsappIcon }}" alt="WhatsApp" class="h-full w-full object-contain" />
    </a>
@endif
