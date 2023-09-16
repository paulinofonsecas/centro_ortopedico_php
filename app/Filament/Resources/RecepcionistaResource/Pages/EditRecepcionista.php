<?php

namespace App\Filament\Resources\RecepcionistaResource\Pages;

use App\Filament\Resources\RecepcionistaResource;
use App\Models\Recepcionista;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditRecepcionista extends EditRecord
{
    protected static string $resource = RecepcionistaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
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
            'estado_da_conta_id' => $data['funcionario']['estadoDaConta']['id'],
        ];

        $user->update($duser);
        $funcionario->update($dfuncionario);
        $endereco->update($dendereco);

        return $record;
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $recepcionista = Recepcionista::find($data['id']);

        $data['user'] = [
            'name' => $recepcionista->funcionario->user->name,
            'email' => $recepcionista->funcionario->user->email,
        ];

        $data['funcionario'] = [
            'telefone' => $recepcionista->funcionario->telefone,
            'estado_da_conta_id' => $recepcionista->funcionario->estadoDaConta->id,
        ];

        $data['endereco'] = [
            'provincia_id' => $recepcionista->funcionario->endereco->provincia_id,
            'municipio_id' => $recepcionista->funcionario->endereco->municipio_id,
            'rua' => $recepcionista->funcionario->endereco->rua,
        ];

        return $data;
    }

}
