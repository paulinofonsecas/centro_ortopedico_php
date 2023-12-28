<?php

namespace App\Filament\pages\dashboards\admin\widgets;

use App\Models\Administrador;
use App\Models\Consulta;
use App\Models\Doacao;
use App\Models\EstadoConsulta;
use App\Models\Medico;
use App\Models\Paciente;
use App\Models\Recepcionista;
use Carbon\Carbon;
use Filament\Support\Colors\Color;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

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
