<?php

namespace App\Filament\App\Resources\DoacaoResource\Pages;

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
            'utente_id' => $data['utente']['name'],
            'item_id' => $data['item']['name'],
            'estado_do_item_id' => $data['estadoDoItem']['name'],
        ];

        return $model;
    }
}
