<?php

namespace App\Filament\Medico\Resources\ConsultaResource\Pages;

use App\Filament\Medico\Resources\ConsultaResource;
use Filament\Actions;
use Filament\Forms\Components\Actions as ComponentsActions;
use Filament\Resources\Pages\ViewRecord;

class ViewConsulta extends ViewRecord
{
    protected static string $resource = ConsultaResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
            // \Filament\actions\Action::make('Processar')
            //     ->label('Processar')
            //     ->color('success')
            //     ->url($this->record->id . '/processar'),
        ];
    }
}