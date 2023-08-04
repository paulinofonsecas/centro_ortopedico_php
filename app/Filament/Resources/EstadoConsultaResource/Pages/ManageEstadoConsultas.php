<?php

namespace App\Filament\Resources\EstadoConsultaResource\Pages;

use App\Filament\Resources\EstadoConsultaResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageEstadoConsultas extends ManageRecords
{
    protected static string $resource = EstadoConsultaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    } 
}
