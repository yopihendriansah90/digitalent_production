<?php

namespace App\Filament\Widgets;

use App\Services\Admin\DashboardDataService;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DashboardStatsWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $kpis = app(DashboardDataService::class)->kpis();

        return [
            Stat::make('Total Halaman', (string) $kpis['total_pages']),
            Stat::make('Konten Lengkap', (string) $kpis['complete_pages'])
                ->color('success'),
            Stat::make('Inquiry Baru', (string) $kpis['inquiry_new'])
                ->color('warning'),
            Stat::make('Update Terakhir', $kpis['last_updated'])
                ->color('primary'),
        ];
    }
}
