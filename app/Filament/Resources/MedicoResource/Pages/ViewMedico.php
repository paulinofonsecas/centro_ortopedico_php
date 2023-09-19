<?php

namespace App\Filament\Resources\MedicoResource\Pages;

use App\Filament\Resources\MedicoResource;
use Filament\Actions;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewMedico extends ViewRecord
{
    protected static string $resource = MedicoResource::class;

    protected function getActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
