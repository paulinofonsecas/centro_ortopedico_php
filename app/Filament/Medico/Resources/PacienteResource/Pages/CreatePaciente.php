<?php

namespace App\Filament\Medico\Resources\PacienteResource\Pages;

use App\Filament\Medico\Resources\PacienteResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePaciente extends CreateRecord
{
    protected static string $resource = PacienteResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->previousUrl ?? $this->getResource()::getUrl('index');
    }
}
