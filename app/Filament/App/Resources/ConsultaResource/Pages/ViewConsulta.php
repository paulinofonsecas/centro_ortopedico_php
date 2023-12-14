<?php

namespace App\Filament\App\Resources\ConsultaResource\Pages;

use App\Filament\App\Resources\ConsultaResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewConsulta extends ViewRecord
{
    protected static string $resource = ConsultaResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
