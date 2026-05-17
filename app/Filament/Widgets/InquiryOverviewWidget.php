<?php

namespace App\Filament\Widgets;

use App\Services\Admin\DashboardDataService;
use Filament\Widgets\Widget;

class InquiryOverviewWidget extends Widget
{
    protected string $view = 'filament.widgets.inquiry-overview-widget';

    protected int | string | array $columnSpan = 1;

    protected function getViewData(): array
    {
        $service = app(DashboardDataService::class);

        return [
            'inquiryStats' => $service->inquiryStats(),
            'recentInquiries' => $service->recentInquiries(),
        ];
    }
}
