<?php

namespace App\Filament\App\Resources\ConsultaResource\Pages;

use App\Filament\App\Resources\ConsultaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListConsultas extends ListRecords
{
    protected static string $resource = ConsultaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
