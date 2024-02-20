<?php

namespace App\Filament\Pages\Dashboards\Admin\Widgets;

use App\Models\Administrador;
use App\Models\Medico;

use App\Models\Recepcionista;
use Filament\Support\Colors\Color;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ControlUsuariosStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Recepcionistas', Recepcionista::count())
                ->description('Cadastrados')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color(Color::Pink),

            Stat::make('Medicos', Medico::count())
                ->description('Cadastrados')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color(Color::Indigo),

            Stat::make('Administradores', Administrador::count())
                ->description('Cadastrados')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color(Color::Teal),
        ];
    }

}
