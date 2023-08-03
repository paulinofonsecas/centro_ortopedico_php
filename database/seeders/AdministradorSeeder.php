<?php

namespace Database\Seeders;

use App\Models\Administrador;
use Illuminate\Database\Seeder;

class AdministradorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Administrador::factory()->count(5)->create();
    }
}
