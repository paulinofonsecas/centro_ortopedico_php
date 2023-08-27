<?php

namespace App\Filament\Pages\dashboards\admin;

use App\Filament\Pages\dashboards\admin\widgets\StatsOverview;
use App\Filament\Pages\dashboards\admin\widgets\ConsultasChart;
use App\Filament\Pages\dashboards\admin\widgets\ControlUsuariosStatsOverview;
use Filament\Pages\Dashboard as BasePage;

class AdminDashboard extends BasePage {

    public function getTitle(): string
    {
        return 'Administração do sistema';
    }

    public function getWidgets(): array
    {
        return [
            StatsOverview::class,
            ConsultasChart::class,
            ControlUsuariosStatsOverview::class,
        ];
    }

    public function getColumns(): array|string|int {
        return 2;
    }

}
