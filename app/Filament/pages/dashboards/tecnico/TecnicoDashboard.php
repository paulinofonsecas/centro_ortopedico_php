<?php

namespace App\Filament\pages\dashboards\tecnico;

use App\Filament\pages\dashboards\tecnico\widgets\StatsOverview;
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
