<?php

namespace App\Filament\Resources\RecepcionistaResource\Pages;

use App\Filament\Resources\RecepcionistaResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRecepcionista extends EditRecord
{
    protected static string $resource = RecepcionistaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
