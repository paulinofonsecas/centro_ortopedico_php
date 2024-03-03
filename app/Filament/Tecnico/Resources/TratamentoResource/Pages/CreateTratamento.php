<?php

namespace App\Filament\Tecnico\Resources\TratamentoResource\Pages;

use App\Filament\Tecnico\Resources\TratamentoResource;
use App\Models\Tecnico;
use App\Models\Tratamento;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateTratamento extends CreateRecord
{
    protected static string $resource = TratamentoResource::class;

    protected static ?string $title = 'Registar Tratamento';


    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $funcionario = auth()->user()->funcionario;
        $tecnico = Tecnico::where(['funcionario_id' => $funcionario->id])->get()->first();

        $data['tecnico_id'] = $tecnico->id;

        return $data;
    }

    protected function handleRecordCreation(array $data): Model
    {
        $tratamento = Tratamento::create([
            'paciente_id' => $data['paciente_id'],
            'tecnico_id' => $data['tecnico_id'],
            'observacoes' => $data['observacoes'],
            'tipo_tratamento_id' => $data['tipo_tratamento_id'],
            'peso' => $data['peso'],
            'ta' => $data['ta'],
        ]);

        // dispara um notificao
        Notification::make()
        ->title('Tratamento registado com sucesso!');

        return $tratamento;
    }
}
