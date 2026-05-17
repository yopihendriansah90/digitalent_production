<x-filament-widgets::widget>
    <div class="space-y-4">
        <x-filament::section>
            <x-slot name="heading">
                <div class="flex items-center gap-2">
                    <x-heroicon-o-inbox-stack class="h-5 w-5 text-amber-600" />
                    <span>Ringkasan Inquiry</span>
                </div>
            </x-slot>
            <div class="grid grid-cols-2 gap-2 text-sm">
                <div class="rounded-lg bg-amber-50 px-3 py-2 dark:bg-amber-900/20"><p class="text-xs text-gray-500">New</p><p class="text-lg font-black text-amber-700 dark:text-amber-300">{{ $inquiryStats['new'] }}</p></div>
                <div class="rounded-lg bg-sky-50 px-3 py-2 dark:bg-sky-900/20"><p class="text-xs text-gray-500">Read</p><p class="text-lg font-black text-sky-700 dark:text-sky-300">{{ $inquiryStats['read'] }}</p></div>
                <div class="rounded-lg bg-emerald-50 px-3 py-2 dark:bg-emerald-900/20"><p class="text-xs text-gray-500">Replied</p><p class="text-lg font-black text-emerald-700 dark:text-emerald-300">{{ $inquiryStats['replied'] }}</p></div>
                <div class="rounded-lg bg-gray-100 px-3 py-2 dark:bg-gray-800"><p class="text-xs text-gray-500">Total</p><p class="text-lg font-black text-gray-800 dark:text-gray-100">{{ $inquiryStats['total'] }}</p></div>
            </div>
        </x-filament::section>

        <x-filament::section>
            <x-slot name="heading">
                <div class="flex items-center gap-2">
                    <x-heroicon-o-clock class="h-5 w-5 text-primary-600" />
                    <span>Inquiry Terbaru</span>
                </div>
            </x-slot>
            <div class="space-y-3">
                @forelse ($recentInquiries as $inquiry)
                    <div class="rounded-xl border border-gray-200 bg-white px-3 py-2 dark:border-gray-700 dark:bg-gray-900">
                        <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ $inquiry->name }}</p>
                        <p class="text-xs text-gray-500">{{ $inquiry->email }}</p>
                        <div class="mt-1 flex items-center justify-between">
                            <span class="text-xs text-gray-500">{{ $inquiry->created_at?->diffForHumans() }}</span>
                            <span class="text-[11px] rounded-full bg-gray-100 px-2 py-1 font-semibold uppercase text-gray-600 dark:bg-gray-800 dark:text-gray-300">{{ $inquiry->status }}</span>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-gray-500">Belum ada inquiry masuk.</p>
                @endforelse
            </div>
        </x-filament::section>
    </div>
</x-filament-widgets::widget>
