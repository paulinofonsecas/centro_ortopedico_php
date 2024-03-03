<?php

namespace App\Filament\Tecnico\Resources\PacienteResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class PacienteIdRelationManager extends RelationManager
{
    protected static string $relationship = 'consultas';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('paciente.nome_completo')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('paciente.nome_completo')
                    ->label('Nome')
                    ->searchable(),

                Tables\Columns\TextColumn::make('paciente.bi')
                    ->label('Número de BI')
                    ->searchable(),

                Tables\Columns\TextColumn::make('paciente.telefone')
                    ->label('Número de telefone')
                    ->searchable(),

                Tables\Columns\TextColumn::make('paciente.genero.name')
                    ->label('Genero'),
            ])
            ->filters([
                //
            ])
            // ->headerActions([
            //     Tables\Actions\CreateAction::make(),
            // ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
