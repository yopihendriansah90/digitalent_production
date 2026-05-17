<?php

namespace App\Filament\Widgets;

use App\Services\Admin\DashboardDataService;
use Filament\Widgets\Widget;

class QuickActionsWidget extends Widget
{
    protected string $view = 'filament.widgets.quick-actions-widget';

    protected int | string | array $columnSpan = 'full';

    protected function getViewData(): array
    {
        $health = app(DashboardDataService::class)->contentHealth();

        return [
            'actions' => $health,
            'siteSettingEditUrl' => app(DashboardDataService::class)->siteSettingEditUrl(),
        ];
    }
}
