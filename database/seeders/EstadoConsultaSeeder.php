<?php

namespace Database\Seeders;

use App\Models\EstadoConsulta;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EstadoConsultaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EstadoConsulta::create(['name' => 'Pendente']);
        EstadoConsulta::create(['name' => 'Em andamento']);
        EstadoConsulta::create(['name' => 'Concluido']);
        EstadoConsulta::create(['name' => 'Cancelado']);
    }
}
