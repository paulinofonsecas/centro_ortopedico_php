<?php

namespace App\Filament\Medico\Resources\FichaAvaliacaoResource\Pages;

use App\Filament\Medico\Resources\FichaAvaliacaoResource;
use App\Models\Consulta;
use App\Models\FichaAvaliacao;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class CreateFichaAvaliacao extends CreateRecord
{
    protected static string $resource = FichaAvaliacaoResource::class;

    protected function getFormActions(): array
    {
        return [];
    }

    protected function getHeaderActions(): array
    {
        return [];
    }

    protected function handleRecordCreation(array $data): Model
    {
        $consultaId = Session::get('consultaId');
        $consulta = Consulta::find($consultaId);

        $data['consulta_id'] = $consulta->id;
        $data['paciente_id'] = $consulta->paciente_id;

        return FichaAvaliacao::create($data);
    }

}
