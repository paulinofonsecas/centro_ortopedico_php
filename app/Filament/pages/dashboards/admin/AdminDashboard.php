<?php

namespace App\Filament\Pages\dashboards\admin;

use App\Filament\Pages\dashboards\admin\widgets\ConsultasChart;
use App\Filament\Pages\dashboards\admin\widgets\ControlUsuariosStatsOverview;
use App\Filament\Pages\dashboards\admin\widgets\StatsOverview;
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
            // ConsultasChart::class,
        ];
    }

    public function getColumns(): array|string|int
    {
        return 2;
    }
}
