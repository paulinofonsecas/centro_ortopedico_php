<?php

namespace App\Filament\Resources\AdministradorResource\Pages;

use App\Filament\Resources\AdministradorResource;
use App\Models\Administrador;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditAdministrador extends EditRecord
{
    protected static string $resource = AdministradorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $user = $record->funcionario->user;
        $funcionario = $record->funcionario;
        $endereco = $record->funcionario->endereco;

        $duser = [
            'name' => $data['user']['name'],
            'email' => $data['user']['email'],
        ];

        $dendereco = [
            'provincia_id' => $data['endereco']['provincia_id'],
            'municipio_id' => $data['endereco']['municipio_id'],
            'rua' =>          $data['endereco']['rua'],
        ];

        $dfuncionario = [
            'telefone' => $data['funcionario']['telefone'],
            'estado_da_conta_id' => $data['funcionario']['estado_da_conta_id'],
        ];

        $user->update($duser);
        $funcionario->update($dfuncionario);
        $endereco->update($dendereco);

        $record->update($data);

        return $record;
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $administrador = Administrador::find($data['id']);

        $data['user'] = [
            'name' => $administrador->funcionario->user->name,
            'email' => $administrador->funcionario->user->email,
        ];

        $data['funcionario'] = [
            'telefone' => $administrador->funcionario->telefone,
            'estado_da_conta_id' => $administrador->funcionario->estado_da_conta_id,
        ];

        $data['endereco'] = [
            'provincia_id' => $administrador->funcionario->endereco->provincia_id,
            'municipio_id' => $administrador->funcionario->endereco->municipio_id,
            'rua' => $administrador->funcionario->endereco->rua,
        ];

        return $data;
    }
}
