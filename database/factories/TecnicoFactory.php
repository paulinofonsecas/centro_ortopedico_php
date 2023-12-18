<?php

namespace Database\Factories;

use App\Models\Endereco;
use App\Models\Funcionario;
use App\Models\Municipio;
use App\Models\Provincia;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tecnico>
 */
class TecnicoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::create([
            'name' => fake()->name(),
            'email' => 'fulano@tec.com',
            'password' => Hash::make('password'),
        ]);

        $provincia = Provincia::create([
           'nome' => fake()->state(),
        ]);

        $municipio = Municipio::create([
           'nome' => fake()->city(),
           'provincia_id' => $provincia->id,
        ]);

        $endereco = Endereco::create([
            'provincia_id' => $provincia->id,
            'municipio_id' => $municipio->id,
            'rua' => fake()->streetName(),
        ]);

        $funcionario = Funcionario::create([
            'telefone' => fake()->phoneNumber(),
            'user_id' => $user->id,
            'endereco_id' => $endereco->id,
            'estado_da_conta_id' => 1,
        ]);

        return [
            'funcionario_id' => $funcionario->id,
            'especialidade_id' => 1,
        ];
    }
}
