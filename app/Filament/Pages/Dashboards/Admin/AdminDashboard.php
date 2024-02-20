<?php

namespace App\Filament\Pages\Dashboards\Admin;

use App\Filament\Pages\Dashboards\Admin\Widgets\ConsultasChart;
use App\Filament\Pages\Dashboards\Admin\Widgets\ControlUsuariosStatsOverview;
use App\Filament\Pages\Dashboards\Admin\Widgets\StatsOverview;
use Filament\Pages\Dashboard as BasePage;

class AdminDashboard extends BasePage
{
    public function getTitle(): string
    {
        return 'Administração do sistema';
    }

    public function getWidgets(): array
    {
        return [
            StatsOverview::class,
            ControlUsuariosStatsOverview::class,
            ConsultasChart::class,
        ];
    }

    public function getColumns(): array|string|int
    {
        return 2;
    }
}
