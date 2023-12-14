<?php

namespace App\Filament\App\Resources\ConsultorioResource\Pages;

use App\Filament\App\Resources\ConsultorioResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageConsultorios extends ManageRecords
{
    protected static string $resource = ConsultorioResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }


}
