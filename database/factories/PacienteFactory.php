<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Paciente>
 */
class PacienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome_completo' => $this->faker->name,
            'bi' => $this->faker->text(14),
            'nascimento' => $this->faker->date(),
            'telefone' => $this->faker->phoneNumber,
            'profissao' => $this->faker->text(20),
            'genero_id' => $this->faker->numberBetween(1, 2),
            'provincia_id' => $this->faker->numberBetween(1, 5),
            'municipio_id' => $this->faker->numberBetween(1, 5),
            'endereco' => $this->faker->address
        ];
    }
}
