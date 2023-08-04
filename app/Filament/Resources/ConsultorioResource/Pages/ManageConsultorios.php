<?php

namespace App\Filament\Resources\ConsultorioResource\Pages;

use App\Filament\Resources\ConsultorioResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageConsultorios extends ManageRecords
{
    protected static string $resource = ConsultorioResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    
}
