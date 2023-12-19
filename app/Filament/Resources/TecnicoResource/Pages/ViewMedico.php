<?php

namespace App\Filament\Resources\TecnicoResource\Pages;

use App\Filament\Resources\TecnicoResource;
use Filament\Actions;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewTecnico extends ViewRecord
{
    protected static string $resource = TecnicoResource::class;

    protected function getActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
