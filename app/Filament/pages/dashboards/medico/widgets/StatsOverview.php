<?php

namespace App\Filament\Pages\dashboards\medico\widgets;

use App\Models\Consulta;
use App\Models\Doacao;
use App\Models\EstadoConsulta;
use App\Models\Paciente;
use Carbon\Carbon;
use Filament\Support\Colors\Color;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $pacientes = $this->getDados('pacientes');
        $consultas = $this->getDados('consultas');
        $doacoes = $this->getDados('doacaos');

        ds($consultas);

        //recuperar o dia atual da semana
        $diaDeHoje = now()->dayOfWeek;

        return [
            Stat::make('Pacientes cadastrados', Paciente::count())
                ->description($pacientes[$diaDeHoje] . ' hoje')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart($pacientes)
                ->color(Color::Pink),

            Stat::make('Consultas marcadas', Consulta::where('estado_consulta_id', EstadoConsulta::CONCLUIDA)->count())
                ->description($consultas[$diaDeHoje] . ' hoje')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart($consultas)
                ->color(Color::Indigo),

            Stat::make('Items doados', Doacao::count())
                ->description($doacoes[$diaDeHoje] . ' hoje')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart($doacoes)
                ->color(Color::Teal),
        ];
    }

    protected function getDados(string $table): array
    {
        // pegar os dados cadastrados na semana
        $dados = DB::table($table)
            ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->get(['created_at']);

        $semana = [0, 0, 0, 0, 0, 0, 0];

        foreach ($dados as $paciente) {
            $data = Carbon::createFromFormat('Y-m-d H:i:s', $paciente->created_at);
            $semana[$data->dayOfWeek]++;
        }

        return $semana;
    }

    public function countElements(array $elements): int
    {
        // somar os elementos do array
        $soma = 0;
        foreach ($elements as $element) {
            $soma += $element;
        }

        return $soma;
    }

}
