<?php

namespace App\Filament\Widgets;

use App\Services\Admin\DashboardDataService;
use Filament\Widgets\Widget;

class ContentHealthWidget extends Widget
{
    protected string $view = 'filament.widgets.content-health-widget';

    protected int | string | array $columnSpan = 2;

    protected function getViewData(): array
    {
        return [
            'health' => app(DashboardDataService::class)->contentHealth(),
        ];
    }
}
