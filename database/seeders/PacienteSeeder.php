<?php

namespace Database\Seeders;

use App\Models\Paciente;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PacienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Paciente::factory()->count(10)->create();

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
                Paciente::create([
                    'nome_completo' => $faker->name,
                    'bi' => $faker->text(14),
                    'nascimento' => $faker->date(),
                    'telefone' => $faker->phoneNumber,
                    'profissao' => $faker->text(20),
                    'genero_id' => $faker->numberBetween(1, 2),
                    'provincia_id' => $faker->numberBetween(1, 5),
                    'municipio_id' => $faker->numberBetween(1, 5),
                    'endereco' => $faker->address,
                    'created_at' => $data,
                ]);
            }
        }
    }
}
