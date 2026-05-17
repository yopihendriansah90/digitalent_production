<x-filament-widgets::widget>
    <x-filament::section>
        <x-slot name="heading">
            <div class="flex items-center gap-2">
                <x-heroicon-o-shield-check class="h-5 w-5 text-emerald-600" />
                <span>Content Health (ID/EN)</span>
            </div>
        </x-slot>
        <x-slot name="description">Cek kelengkapan field wajib per halaman.</x-slot>

        <div class="space-y-3">
            @foreach ($health as $item)
                <a href="{{ $item['route'] }}" class="flex items-center justify-between rounded-xl border border-gray-200 bg-white px-4 py-3 transition hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-900 dark:hover:bg-gray-800/50">
                    <div>
                        <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ $item['label'] }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">{{ $item['updated_at'] ? $item['updated_at']->diffForHumans() : 'Belum pernah diperbarui' }}</p>
                        @if (! $item['is_complete'])
                            <p class="mt-1 text-xs text-amber-700 dark:text-amber-300">Kosong: {{ collect($item['missing_fields'])->take(3)->implode(', ') }}{{ count($item['missing_fields']) > 3 ? ' ...' : '' }}</p>
                        @endif
                    </div>
                    <span class="inline-flex items-center gap-1 rounded-full px-3 py-1 text-xs font-bold {{ $item['is_complete'] ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-300' : 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-300' }}">
                        @if ($item['is_complete'])
                            <x-heroicon-m-check-circle class="h-3.5 w-3.5" />
                        @else
                            <x-heroicon-m-exclamation-triangle class="h-3.5 w-3.5" />
                        @endif
                        {{ $item['is_complete'] ? 'Lengkap' : 'Perlu Lengkapi' }}
                    </span>
                </a>
            @endforeach
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
