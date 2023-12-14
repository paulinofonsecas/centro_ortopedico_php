<?php

namespace App\Http\Livewire\Widgets;

use App\Models\User;
use Filament\Widgets\Widget;
use Illuminate\Database\Eloquent\Builder;

class TarefasNaoVistasRecepcionista extends Widget implements \Filament\Tables\Contracts\HasTable

{
    use \Filament\Tables\Concerns\InteractsWithTable;

    protected static ?int $sort = 4;

    protected static string $view = 'livewire.widgets.tarefas-nao-vistas-recepcionista';

    protected int | array | string $columnSpan = 'full';

    /**
     * Summary of render
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */

    protected function getTableQuery(): Builder
    {
        return User::query();
    }

    protected function getTableColumns(): array// [tl! focus:start]
    {
        return [ // [tl! collapse:start]
            \Filament\Tables\Columns\TextColumn::make('name')
                ->searchable(),
            \Filament\Tables\Columns\TextColumn::make('email'),
        ]; // [tl! collapse:end]
    }

}
