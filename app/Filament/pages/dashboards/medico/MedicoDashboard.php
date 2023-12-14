<?php

namespace App\Filament\Pages\dashboards\medico;

use App\Filament\Medico\Resources\MedicoResource\Widgets\ConsultasDeHoje;
use App\Filament\Pages\dashboards\medico\widgets\StatsOverview;
use Filament\Pages\Dashboard as BasePage;

class MedicoDashboard extends BasePage {

    public function getTitle(): string
    {
        return 'Painel do Médico';
    }

    public function getWidgets(): array
    {
        return [
            StatsOverview::class,
            ConsultasDeHoje::class,
        ];
    }

    public function getColumns(): array|string|int {
        return 2;
    }

}
