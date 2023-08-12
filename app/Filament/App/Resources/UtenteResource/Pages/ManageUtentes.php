<?php

namespace App\Filament\App\Resources\UtenteResource\Pages;

use App\Filament\App\Resources\UtenteResource;
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
