<?php

namespace Database\Seeders;

use App\Models\EstadoDoItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EstadoItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EstadoDoItem::create(['name' => 'Pendente']);
        EstadoDoItem::create(['name' => 'Usado e em boas condições']);
        EstadoDoItem::create(['name' => 'recondicionado']);
    }
}
