<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TipoTratamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tiposTratamentos = [
            'Exercícios terapêuticos',
            'Terapia manual',
            'Eletroterapia',
            'Terapia por ondas de choque',
            'Crioterapia',
            'Terapia a quente',
            'Terapia de tração',
        ];

        foreach ($tiposTratamentos as $tipoTratamento) {
            \App\Models\TipoTratamento::create([
                'nome' => $tipoTratamento,
            ]);
        }
    }
}
