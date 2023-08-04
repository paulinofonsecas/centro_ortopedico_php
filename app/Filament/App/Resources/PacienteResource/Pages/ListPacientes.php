<?php

namespace App\Filament\App\Resources\PacienteResource\Pages;

use App\Filament\App\Resources\PacienteResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPacientes extends ListRecords
{
    protected static string $resource = PacienteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
