<?php

namespace App\Filament\Resources\MedicoResource\Pages;

use App\Filament\Resources\MedicoResource;
use App\Models\Medico;
use App\Models\Recepcionista;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditMedico extends EditRecord
{
    protected static string $resource = MedicoResource::class;

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

        $data['especialidade_id'] = $data['especialidade']['id'];

        $record->update($data);

        return $record;
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $medico = Medico::find($data['id']);

        $data['user'] = [
            'name' => $medico->funcionario->user->name,
            'email' => $medico->funcionario->user->email,
        ];

        $data['funcionario'] = [
            'telefone' => $medico->funcionario->telefone,
            'estado_da_conta_id' => $medico->funcionario->estado_da_conta_id,
        ];

        $data['endereco'] = [
            'provincia_id' => $medico->funcionario->endereco->provincia_id,
            'municipio_id' => $medico->funcionario->endereco->municipio_id,
            'rua' => $medico->funcionario->endereco->rua,
        ];

        $data['especialidade'] = [
            'id' => $medico->especialidade->id,
        ];

        return $data;
    }
}
