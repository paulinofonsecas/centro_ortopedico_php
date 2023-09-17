<?php

namespace App\Filament\Pages\dashboards\medico\widgets;

use App\Models\EstadoConsulta;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class ConsultasChart extends ApexChartWidget
{
    /**
     * Chart Id
     *
     * @var string
     */
    protected static string $chartId = 'adminConsultasChart';

    protected static ?string $pollingInterval = null;

    protected static ?string $heading = 'Consultas realizadas';

    protected int | string | array $columnSpan = 'full';

    public ?string $filter = ConsultasChart::DIA;

    public const DIA  = 'Hoje';
    public const SEMANA = 'Esta semana';
    public const MES    = 'Este mês';
    public const ANO    = 'Este ano';

    /**
     * Widget Title
     *
     * @var string|null
     */

    protected function getFilters(): ?array
    {
        return [
            ConsultasChart::DIA    => 'Dia',
            ConsultasChart::SEMANA => 'Semana passada',
            ConsultasChart::MES    => 'Mês passado',
            ConsultasChart::ANO    => 'Este ano',
        ];
    }

    public function getDadosDiarios($dados)
    {
        $diario = [0, 0, 0, 0, 0, 0, 0];

        foreach ($dados as $dado) {
            $data = Carbon::createFromFormat('Y-m-d H:i:s', $dado->created_at);
            $diario[$data->dayOfWeek]++;
        }

        return $diario;
    }

    public function getDadosAnuais($dados)
    {
        $ano = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

        foreach ($dados as $dado) {
            $data = Carbon::createFromFormat('Y-m-d H:i:s', $dado->created_at);
            $ano[$data->month - 1]++;
        }

        return $ano;
    }

    protected function getDadosPendentes($estadoConsulta, $table = 'consultas'): array
    {

        $dados = DB::table($table)
        ->where('estado_consulta_id', $estadoConsulta)
        ->whereBetween('created_at', [
            now()->startOfYear(), now()->endOfYear()
        ])->get(['created_at']);

        return $this->getData($dados);
    }

    public function getData($dados): array
    {
        $activeFilter = $this->filter;

        if ($activeFilter === ConsultasChart::DIA) {
            return $this->getDadosDiarios($dados);
        } elseif ($activeFilter === ConsultasChart::ANO) {
            return $this->getDadosAnuais($dados);
        }

    }

    public function getCategories(): array
    {
        $activeFilter = $this->filter;

        if ($activeFilter === ConsultasChart::DIA) {
            return ['07h', '08h', '09h', '10h', '11h', '12h', '13h', '14h', '15h', '16h', '17h', '18h'];
        } elseif ($activeFilter === ConsultasChart::SEMANA) {
            return ['01', '02', '03', '04', '05', '06', '07'];
        } elseif ($activeFilter === ConsultasChart::MES) {
            return ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31'];
        } elseif ($activeFilter === ConsultasChart::ANO) {
            return ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        }
    }

    /**
     * Chart options (series, labels, types, size, animations...)
     * https://apexcharts.com/docs/options
     *
     * @return array
     */
    protected function getOptions(): array
    {

        return [
            'chart' => [
                'type' => 'line',
                'height' => 400,
            ],
            'series' => [
                [
                    'name' => 'Consultas pendentes',
                    'data' => $this->getDadosPendentes(EstadoConsulta::CONCLUIDA),
                ],
                [
                    'name' => 'Consultas em andamento',
                    'data' => $this->getDadosPendentes(EstadoConsulta::CONCLUIDA),
                ],
                [
                    'name' => 'Consultas concluidas',
                    'data' => $this->getDadosPendentes(EstadoConsulta::CONCLUIDA),
                ],
            ],
            'xaxis' => [
                'categories' => $this->getCategories(),
                'labels' => [
                    'style' => [
                        'fontFamily' => 'inherit',
                    ],
                ],
            ],
            'yaxis' => [
                'labels' => [
                    'style' => [
                        'fontFamily' => 'inherit',
                    ],
                ],
            ],
            'colors' => ['#f59e0b'],
            'stroke' => [
                'curve' => 'smooth',
            ],
        ];
    }
}
