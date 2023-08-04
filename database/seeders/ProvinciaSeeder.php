<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Provincia;

class ProvinciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $provincias = [
            'Bengo',
            'Benguela',
            'Bié',
            'Cabinda',
            'Cuando Cubango',
            'Cuanza Norte',
            'Cuanza Sul',
            'Cunene',
            'Huambo',
            'Huíla',
            'Luanda',
            'Lunda Norte',
            'Lunda Sul',
            'Malanje',
            'Moxico',
            'Namibe',
            'Uíge',
            'Zaire'
        ];

        foreach ($provincias as $provincia) {
            Provincia::create(['nome' => $provincia]);
        }
    }
}
