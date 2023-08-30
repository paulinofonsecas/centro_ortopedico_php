<?php

namespace App\Filament\Medico\Resources\FichaAvaliacaoResource\Pages;

use App\Filament\Medico\Resources\FichaAvaliacaoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFichaAvaliacaos extends ListRecords
{
    protected static string $resource = FichaAvaliacaoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
