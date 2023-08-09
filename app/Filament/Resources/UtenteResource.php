<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UtenteResource\Pages;
use App\Filament\Resources\UtenteResource\RelationManagers;
use App\Models\Utente;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UtenteResource extends Resource
{
    protected static ?string $model = Utente::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nome')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('bi')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('telefone')
                    ->tel()
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('nascimento')
                    ->required(),
                Forms\Components\TextInput::make('nome_pai')
                    ->label('Nome do pai')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('nome_mae')
                    ->label('Nome da mãe')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function title()
    {
        return 'Novo Título do Formulário';
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nome')
                    ->searchable(),
                Tables\Columns\TextColumn::make('bi')
                    ->searchable(),
                Tables\Columns\TextColumn::make('telefone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nascimento')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nome_pai')
                    ->label('Nome do pai')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nome_mae')
                    ->label('Nome da mãe')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
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
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageUtentes::route('/'),
        ];
    }    
}
