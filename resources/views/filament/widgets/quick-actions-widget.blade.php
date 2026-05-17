<x-filament-widgets::widget>
    <x-filament::section>
        <x-slot name="heading">
            <div class="flex items-center gap-2">
                <x-heroicon-o-bolt class="h-5 w-5 text-primary-600" />
                <span>Quick Actions</span>
            </div>
        </x-slot>
        <x-slot name="description">Akses cepat ke halaman edit konten utama.</x-slot>

        <div class="grid gap-3 sm:grid-cols-2 lg:grid-cols-4">
            <a href="{{ $siteSettingEditUrl }}" class="group rounded-xl border border-primary-200 bg-primary-50/50 px-4 py-3.5 text-sm font-semibold text-primary-700 transition hover:-translate-y-0.5 hover:bg-primary-50 dark:border-primary-800 dark:bg-primary-900/20 dark:text-primary-300">
                <div class="flex items-center justify-between">
                    <span>Pengaturan Website</span>
                    <x-heroicon-o-cog-6-tooth class="h-4 w-4 opacity-70 group-hover:opacity-100" />
                </div>
            </a>
            @foreach ($actions as $item)
                <a href="{{ $item['route'] }}" class="group rounded-xl border border-gray-200 bg-white px-4 py-3.5 text-sm font-semibold text-gray-700 transition hover:-translate-y-0.5 hover:border-primary-300 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-200 dark:hover:border-primary-700 dark:hover:bg-gray-800/50">
                    <div class="flex items-center justify-between">
                        <span>Edit {{ $item['label'] }}</span>
                        <x-heroicon-o-pencil-square class="h-4 w-4 opacity-60 group-hover:opacity-100" />
                    </div>
                </a>
            @endforeach
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
