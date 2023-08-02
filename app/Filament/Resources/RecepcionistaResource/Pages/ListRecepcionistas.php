<?php

namespace App\Filament\Resources\RecepcionistaResource\Pages;

use App\Filament\Resources\RecepcionistaResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRecepcionistas extends ListRecords
{
    protected static string $resource = RecepcionistaResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
