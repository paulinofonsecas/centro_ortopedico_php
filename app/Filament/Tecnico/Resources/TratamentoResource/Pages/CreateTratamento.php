<?php

namespace App\Filament\Tecnico\Resources\TratamentoResource\Pages;

use App\Filament\Tecnico\Resources\TratamentoResource;
use App\Models\Tecnico;
use Filament\Resources\Pages\CreateRecord;

class CreateTratamento extends CreateRecord
{
    protected static string $resource = TratamentoResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $funcionario = auth()->user()->funcionario;
        $medico = Tecnico::where(['funcionario_id' => $funcionario->id])->get()->first();
        
        $data['medico_id'] = $medico->id;

        return $data;
    }
}
