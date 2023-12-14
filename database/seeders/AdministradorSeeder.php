<?php

namespace Database\Seeders;

use App\Models\Administrador;
use App\Models\Endereco;
use App\Models\Funcionario;
use App\Models\User;
use Illuminate\Database\Seeder;

class AdministradorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Administrador',
            'email' => 'admin@admin.com',
            'password' => bcrypt('SuperAdmin1.23'),
        ]);

        $endereco = Endereco::create([
            'provincia_id' => 1,
            'municipio_id' => 1,
            'rua' => 'Rua 1',
        ]);

        $funcionario = Funcionario::create([
            'user_id' => $user->id,
            'telefone' => '(11) 1111-1111',
            'endereco_id' => $endereco->id,
            'estado_da_conta_id' => 1,
        ]);

        $admin = Administrador::create([
            'funcionario_id' => $funcionario->id,
        ]);

        $user->assignRole('admin');
    }
}
