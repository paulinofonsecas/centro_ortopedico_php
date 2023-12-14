<?php

namespace Database\Seeders;

use App\Models\Gravidade;
use Illuminate\Database\Seeder;

class GravidadeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Gravidade::create(['name' => 'Baixa']);
        Gravidade::create(['name' => 'Média']);
        Gravidade::create(['name' => 'Alta']);
        Gravidade::create(['name' => 'Emergência']);
    }
}
