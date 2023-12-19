<?php

namespace App\Filament\Tecnico\Resources;

use App\Filament\Tecnico\Resources\DoacaoResource\Pages;
use App\Models\Doacao;
use App\Models\EstadoDoItem;
use App\Models\Item;
use App\Models\Utente;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class DoacaoResource extends Resource
{
    protected static ?string $model = Doacao::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Distribuição de equipamentos';

    protected static ?string $slug = 'equipamentos';
    
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('utente_id')
                    ->label('Utente')
                    ->required()
                    ->options(Utente::all()->pluck('name', 'id'))
                    ->searchable(),
                Forms\Components\Select::make('item_id')
                    ->label('Equipamento')
                    ->required()
                    ->options(Item::all()->pluck('name', 'id'))
                    ->searchable(),
                Forms\Components\Select::make('estado_do_item_id')
                    ->label('Estado do equipamento')
                    ->required()
                    ->options(EstadoDoItem::all()->pluck('name', 'id'))
                    ->searchable(),
                Forms\Components\TextInput::make('quantidade')
                    ->required()
                    ->numeric(),
                Forms\Components\Textarea::make('obs')
                    ->maxLength(65535)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('utente.name')
                    ->label('Utente')
                    ->sortable(),
                Tables\Columns\TextColumn::make('item.name')
                    ->label('Equipamento')
                    ->sortable(),
                Tables\Columns\TextColumn::make('estadoDoItem.name')
                    ->label('Estado do equipamento')
                    ->sortable(),
                Tables\Columns\TextColumn::make('quantidade')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('obs')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([

            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDoacaos::route('/'),
            'create' => Pages\CreateDoacao::route('/create'),
            'edit' => Pages\EditDoacao::route('/{record}/edit'),
        ];
    }    
}
