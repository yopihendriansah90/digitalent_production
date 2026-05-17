<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class VisitorHistoryChartWidget extends ChartWidget
{
    protected ?string $heading = 'Histori Visitor (7 Hari Terakhir)';

    protected ?string $description = 'Grafik jumlah visitor harian website company profile.';

    protected ?string $pollingInterval = '15s';
    
    public ?string $filter = '7d';

    protected function getData(): array
    {
        $activeFilter = $this->filter ?? '7d';
        [$labels, $values] = match ($activeFilter) {
            '30d' => $this->buildDailySeries(30),
            '12m' => $this->buildMonthlySeries(12),
            default => $this->buildDailySeries(7),
        };

        return [
            'datasets' => [
                [
                    'label' => 'Visitor',
                    'data' => $values,
                    'borderColor' => '#0ea5e9',
                    'backgroundColor' => 'rgba(14, 165, 233, 0.15)',
                    'fill' => true,
                    'tension' => 0.35,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getFilters(): ?array
    {
        return [
            '7d' => '7 Hari',
            '30d' => '30 Hari',
            '12m' => '12 Bulan',
        ];
    }

    protected function buildDailySeries(int $days): array
    {
        $startDate = now()->subDays($days - 1)->startOfDay();
        $endDate = now()->endOfDay();

        $rows = DB::table('visitor_sessions')
            ->selectRaw('DATE(last_seen_at) as visit_date, COUNT(*) as total')
            ->whereBetween('last_seen_at', [$startDate, $endDate])
            ->groupBy('visit_date')
            ->orderBy('visit_date')
            ->pluck('total', 'visit_date')
            ->all();

        $labels = [];
        $values = [];
        $cursor = $startDate->copy();

        while ($cursor->lte($endDate)) {
            $key = $cursor->toDateString();
            $labels[] = $cursor->translatedFormat('d M');
            $values[] = (int) ($rows[$key] ?? 0);
            $cursor->addDay();
        }

        return [$labels, $values];
    }

    protected function buildMonthlySeries(int $months): array
    {
        $start = now()->subMonths($months - 1)->startOfMonth();
        $end = now()->endOfMonth();

        $rows = DB::table('visitor_sessions')
            ->selectRaw('DATE_FORMAT(last_seen_at, "%Y-%m") as period_key, COUNT(*) as total')
            ->whereBetween('last_seen_at', [$start, $end])
            ->groupBy('period_key')
            ->orderBy('period_key')
            ->pluck('total', 'period_key')
            ->all();

        $labels = [];
        $values = [];
        $cursor = $start->copy();

        while ($cursor->lte($end)) {
            $key = $cursor->format('Y-m');
            $labels[] = $cursor->translatedFormat('M Y');
            $values[] = (int) ($rows[$key] ?? 0);
            $cursor->addMonth();
        }

        return [$labels, $values];
    }
}
