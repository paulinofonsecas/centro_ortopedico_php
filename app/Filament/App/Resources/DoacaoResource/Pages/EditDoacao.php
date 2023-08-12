<?php

namespace App\Filament\App\Resources\DoacaoResource\Pages;

use App\Filament\App\Resources\DoacaoResource;
use App\Models\Doacao;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditDoacao extends EditRecord
{
    protected static string $resource = DoacaoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        return Doacao::create([
            'quantidade' => $data['quantidade'],
            'obs' => $data['obs'],
            'utente_id' => $data['utente_id'],
            'item_id' => $data['item_id'],
            'estado_do_item_id' => $data['estado_do_item_id'],
        ]);
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $doacao = Doacao::find($data['id']);
        $saida = [];

        $saida['quantidade'] = $doacao->quantidade;
        $saida['obs'] = $doacao->obs;
        $saida['utente_id'] = $doacao->utente->id;
        $saida['item_id'] = $doacao->item->id;
        $saida['estado_do_item_id'] = $doacao->estadoDoItem->id;
    
        return $saida;
    }
}
