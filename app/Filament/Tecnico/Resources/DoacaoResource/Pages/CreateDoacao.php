<?php

namespace App\Filament\Tecnico\Resources\DoacaoResource\Pages;

use App\Filament\Tecnico\Resources\DoacaoResource;
use Filament\Resources\Pages\CreateRecord;

class CreateDoacao extends CreateRecord
{
    protected static string $resource = DoacaoResource::class;

    protected static ?string $title = 'Distribuir equipamento';


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
