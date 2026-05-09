<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? config('app.name', 'DigiTalent') }}</title>
    @php
        $hasViteManifest = file_exists(public_path('build/manifest.json'));
        $hasViteHotFile = file_exists(public_path('hot'));
    @endphp
    @if ($hasViteManifest || $hasViteHotFile)
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body class="min-h-screen bg-slate-50 text-slate-900 antialiased">
    @include('partials.header')

    <main class="mx-auto w-full max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        @yield('content')
    </main>

    @include('partials.footer')
</body>
</html>
