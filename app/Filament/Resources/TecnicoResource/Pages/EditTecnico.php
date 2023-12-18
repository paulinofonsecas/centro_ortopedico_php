<?php

namespace App\Filament\Resources\TecnicoResource\Pages;

use App\Filament\Resources\TecnicoResource;
use App\Models\Tecnico;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditTecnico extends EditRecord
{
    protected static string $resource = TecnicoResource::class;

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
            'rua' => $data['endereco']['rua'],
        ];

        $dfuncionario = [
            'telefone' => $data['funcionario']['telefone'],
            'estado_da_conta_id' => $data['funcionario']['estado_da_conta_id'],
        ];

        $user->update($duser);
        $funcionario->update($dfuncionario);
        $endereco->update($dendereco);

        $record->update([
            'especialidade_id' => $data['especialidade']['id'],
        ]);

        return $record;
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $tecnico = Tecnico::find($data['id']);

        $data['user'] = [
            'name' => $tecnico->funcionario->user->name,
            'email' => $tecnico->funcionario->user->email,
        ];

        $data['funcionario'] = [
            'telefone' => $tecnico->funcionario->telefone,
            'estado_da_conta_id' => $tecnico->funcionario->estado_da_conta_id,
        ];

        $data['endereco'] = [
            'provincia_id' => $tecnico->funcionario->endereco->provincia_id,
            'municipio_id' => $tecnico->funcionario->endereco->municipio_id,
            'rua' => $tecnico->funcionario->endereco->rua,
        ];

        $data['especialidade'] = [
            'id' => $tecnico->especialidade->id,
        ];

        return $data;
    }
}
