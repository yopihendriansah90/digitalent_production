<footer class="border-t border-slate-200 bg-white">
    <div class="mx-auto flex w-full max-w-7xl flex-col gap-2 px-4 py-6 text-sm text-slate-600 sm:px-6 lg:px-8 md:flex-row md:items-center md:justify-between">
        <p>{{ $siteSetting->copyright_text ?? ('© '.date('Y').' DigiTalent. All rights reserved.') }}</p>
        <p>{{ $siteSetting->tagline ?? 'Company Profile Website' }}</p>
    </div>
</footer>
