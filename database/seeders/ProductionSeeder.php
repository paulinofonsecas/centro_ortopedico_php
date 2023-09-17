<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            ProvinciaSeeder::class,
            EstadoDaContaSeeder::class,
            EstadoConsultaSeeder::class,
            EstadoItemSeeder::class,
            GeneroSeeder::class,
            GravidadeSeeder::class,
            RoleSeeder::class,
            AdministradorSeeder::class,
        ]);
    }
}
