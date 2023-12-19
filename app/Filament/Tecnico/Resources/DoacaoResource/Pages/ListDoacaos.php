<?php

namespace App\Filament\Tecnico\Resources\DoacaoResource\Pages;

use App\Filament\Tecnico\Resources\DoacaoResource;
use App\Filament\Tecnico\Resources\UtenteResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDoacaos extends ListRecords
{
    protected static string $resource = DoacaoResource::class;
    protected static ?string $title = 'Distruição de equipamentos';
    
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
