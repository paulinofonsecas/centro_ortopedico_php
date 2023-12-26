<?php

namespace App\Filament\Resources\AdministradorResource\Pages;

use App\Filament\Resources\AdministradorResource;
use App\Models\Endereco;
use App\Models\EstadoDaConta;
use App\Models\Funcionario;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Hash;

class CreateAdministrador extends CreateRecord
{
    protected static string $resource = AdministradorResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $user = User::create([
            'name' => $data['user']['name'],
            'email' => $data['user']['email'],
            'password' => Hash::make($data['user']['password']),
            ]);

        $user->assignRole('admin');
        $userId = $user->id;

        $enderecoId = Endereco::create([
            'provincia_id' => $data['endereco']['provincia_id'],
            'municipio_id' => $data['endereco']['municipio_id'],
            'rua' => $data['endereco']['rua'],
        ])->id;
        $funcionarioId = Funcionario::create([
            'telefone' => $data['funcionario']['telefone'],
            'estado_da_conta_id' => 1,
            'user_id' => $userId,
            'endereco_id' => $enderecoId,
        ])->id;
        
        $data = [
            'funcionario_id' => $funcionarioId
        ];

        return $data;
    }
}
