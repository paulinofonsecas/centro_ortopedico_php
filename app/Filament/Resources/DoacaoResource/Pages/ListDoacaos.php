<?php

namespace App\Filament\Resources\DoacaoResource\Pages;

use App\Filament\App\Resources\DoacaoResource;
use App\Filament\App\Resources\UtenteResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDoacaos extends ListRecords
{
    protected static string $resource = DoacaoResource::class;
    protected static ?string $title = 'Doações feitas';
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
