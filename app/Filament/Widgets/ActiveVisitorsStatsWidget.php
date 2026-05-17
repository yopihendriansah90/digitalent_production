<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class ActiveVisitorsStatsWidget extends StatsOverviewWidget
{
    protected ?string $pollingInterval = '10s';

    protected function getStats(): array
    {
        $activeVisitors = DB::table('visitor_sessions')
            ->where('last_seen_at', '>=', now()->subMinutes(5))
            ->count();

        $todayVisitors = DB::table('visitor_sessions')
            ->whereDate('last_seen_at', today())
            ->count();

        $monthVisitors = DB::table('visitor_sessions')
            ->whereYear('last_seen_at', now()->year)
            ->whereMonth('last_seen_at', now()->month)
            ->count();

        return [
            Stat::make('Pengunjung Aktif (5 menit)', number_format($activeVisitors))
                ->description('Visitor yang sedang online di website')
                ->icon('heroicon-o-signal'),
            Stat::make('Total Visitor Hari Ini', number_format($todayVisitors))
                ->description('Akumulasi visitor hari ini')
                ->icon('heroicon-o-calendar-days'),
            Stat::make('Total Visitor Bulan Ini', number_format($monthVisitors))
                ->description('Akumulasi visitor bulan berjalan')
                ->icon('heroicon-o-chart-bar-square'),
        ];
    }
}
