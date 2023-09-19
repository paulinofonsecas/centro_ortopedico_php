<?php

namespace App\Filament\Resources\TipoTratamentoResource\Pages;

use App\Filament\Resources\TipoTratamentoResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageTipoTratamentos extends ManageRecords
{
    protected static string $resource = TipoTratamentoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
