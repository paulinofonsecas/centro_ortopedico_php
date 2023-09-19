<?php

namespace App\Filament\Medico\Resources\FichaAvaliacaoResource\Pages;

use App\Filament\Medico\Resources\FichaAvaliacaoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFichaAvaliacao extends EditRecord
{
    protected static string $resource = FichaAvaliacaoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
