<?php

namespace App\Filament\Pages\dashboards\medico;

use App\Filament\Pages\dashboards\medico\widgets\StatsOverview;
use Filament\Pages\Dashboard as BasePage;

class MedicoDashboard extends BasePage {

    public function getTitle(): string
    {
        return 'Administração do sistema';
    }

    public function getWidgets(): array
    {
        return [
            StatsOverview::class,
        ];
    }

    public function getColumns(): array|string|int {
        return 2;
    }

}
