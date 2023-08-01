<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Closure;
use Filament\Tables;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class OMeuDia extends BaseWidget
{

    protected static ?int $sort = 1;

    protected int | string | array $columnSpan = 3;

    protected function getTableQuery(): Builder
    {
        return User::query();
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('name'),
            Tables\Columns\TextColumn::make('email'),
            Tables\Columns\TextColumn::make('created_at')
                ->dateTime('d/m/Y H:i'),
        ];
    }
}
