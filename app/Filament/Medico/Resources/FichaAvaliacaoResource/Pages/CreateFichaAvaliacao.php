<?php

namespace App\Filament\Medico\Resources\FichaAvaliacaoResource\Pages;

use App\Filament\Medico\Resources\FichaAvaliacaoResource;
use App\Models\FichaAvaliacao;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

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
        $record = $this->form->getRecord();

        ds($record);
        return FichaAvaliacao::create();
    }

}
