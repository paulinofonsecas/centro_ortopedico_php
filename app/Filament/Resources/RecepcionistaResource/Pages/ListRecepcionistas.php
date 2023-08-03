<?php

namespace App\Filament\Resources\RecepcionistaResource\Pages;

use App\Filament\Resources\RecepcionistaResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\CreateAction;

class ListRecepcionistas extends ListRecords
{
    protected static string $resource = RecepcionistaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
