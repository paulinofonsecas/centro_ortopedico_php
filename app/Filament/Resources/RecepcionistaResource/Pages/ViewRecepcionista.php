<?php

namespace App\Filament\Resources\RecepcionistaResource\Pages;

use App\Filament\Resources\RecepcionistaResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewRecepcionista extends ViewRecord
{
    protected static string $resource = RecepcionistaResource::class;

    protected function getActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
