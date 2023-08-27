<?php

namespace Database\Seeders;

use App\Models\Doacao;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DoacaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // popular dados na tabela com data aleatória entre 21/08/2023 a 27/08/2023
        $datas = [
            '2023-08-21',
            '2023-08-22',
            '2023-08-23',
            '2023-08-24',
            '2023-08-25',
            '2023-08-26',
            '2023-08-27',
        ];

        $faker = \Faker\Factory::create();
        foreach ($datas as $data) {
            $g = random_int(1, 10);
            for ($i=0; $i < $g; $i++) { 
                Doacao::create([
                    'quantidade' => random_int(1, 10),
                    'obs' => $faker->sentence,
                    'utente_id' => 1,
                    'item_id' => 1,
                    'estado_do_item_id' => 1,
                    'created_at' => $data,
                ]);
            }
        }
    }
}
