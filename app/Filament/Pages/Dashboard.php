<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\ActiveVisitorsStatsWidget;
use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-squares-2x2';

    protected static ?string $title = 'Dashboard Admin';

    protected static ?string $navigationLabel = 'Dashboard';

    protected static ?int $navigationSort = 1;

    public function getWidgets(): array
    {
        return [
            ActiveVisitorsStatsWidget::class,
        ];
    }
}
