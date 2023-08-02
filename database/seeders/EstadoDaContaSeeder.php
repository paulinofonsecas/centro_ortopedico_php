<?php

namespace Database\Seeders;

use App\Models\EstadoDaConta;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EstadoDaContaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EstadoDaConta::create(['nome' => 'Activa']);
        EstadoDaConta::create(['nome' => 'inativa']);
        EstadoDaConta::create(['nome' => 'Desactivada']);
    }
}
