<?php

namespace App\Filament\Medico\Resources\TratamentoResource\Pages;

use App\Filament\Medico\Resources\TratamentoResource;
use App\Models\Medico;
use Filament\Resources\Pages\CreateRecord;

class CreateTratamento extends CreateRecord
{
    protected static string $resource = TratamentoResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $funcionario = auth()->user()->funcionario;
        $medico = Medico::where(['funcionario_id' => $funcionario->id])->get()->first();
        
        $data['medico_id'] = $medico->id;

        return $data;
    }
}
