<?php

namespace App\Filament\Resources\DoacaoResource\Pages;

use App\Filament\App\Resources\DoacaoResource;
use App\Models\Doacao;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDoacao extends CreateRecord
{
    protected static string $resource = DoacaoResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $model = [
            'quantidade' => $data['quantidade'],
            'obs' => $data['obs'],
            'utente_id' => $data['utente_id'],
            'item_id' => $data['item_id'],
            'estado_do_item_id' => $data['estado_do_item_id'],
        ];

        return $model;
    }
}
