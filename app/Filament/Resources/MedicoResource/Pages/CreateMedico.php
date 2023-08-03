<?php

namespace App\Filament\Resources\MedicoResource\Pages;

use App\Filament\Resources\MedicoResource;
use App\Models\Endereco;
use App\Models\Especialidade;
use App\Models\Funcionario;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Hash;

class CreateMedico extends CreateRecord
{
    protected static string $resource = MedicoResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $user = User::create([
            'name' => $data['user']['name'],
            'email' => $data['user']['email'],
            'password' => Hash::make($data['user']['password']),
        ]);

        $endereco = Endereco::create([
            'provincia_id' => $data['endereco']['provincia_id'],
            'municipio_id' => $data['endereco']['municipio_id'],
            'rua' => $data['endereco']['rua'],
        ]);

        $funcionario = Funcionario::create([
            'telefone' => $data['funcionario']['telefone'],
            'user_id' => $user->id,
            'endereco_id' => $endereco->id,
            'estado_da_conta_id' => 1,
        ]);

        return[
            'funcionario_id' => $funcionario->id,
            'especialidade_id' => $data['especialidade']['id'],
        ];
    }
}
