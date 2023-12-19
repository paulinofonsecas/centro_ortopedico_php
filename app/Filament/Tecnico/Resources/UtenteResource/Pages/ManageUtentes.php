<?php

namespace App\Filament\Tecnico\Resources\UtenteResource\Pages;

use App\Filament\Tecnico\Resources\UtenteResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageUtentes extends ManageRecords
{
    protected static string $resource = UtenteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
