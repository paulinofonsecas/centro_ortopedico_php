<?php

namespace Database\Seeders;

use App\Models\Recepcionista;
use Illuminate\Database\Seeder;

class RecepcionistaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Recepcionista::factory(10)->create();
    }
}
