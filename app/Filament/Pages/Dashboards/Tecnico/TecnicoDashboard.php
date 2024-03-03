<?php

namespace App\Filament\Pages\Dashboards\Tecnico;

use App\Filament\Pages\Dashboards\Tecnico\widgets\StatsOverview;
use Filament\Pages\Dashboard as BasePage;

class TecnicoDashboard extends BasePage {

    public function getTitle(): string
    {
        return 'Painel do Técnico';
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
