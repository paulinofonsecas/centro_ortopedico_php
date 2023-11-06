<?php

namespace App\Filament\Medico\Resources\PacienteResource\RelationManagers;

use App\Filament\Medico\Resources\TratamentoResource;
use App\Models\Tratamento;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TratamentoResourceRelationManager extends RelationManager
{
    protected static string $relationship = 'tratamentos';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('paciente_id')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('paciente_id')
            ->defaultSort('data', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('hc')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('paciente.nome_completo')
                    ->label('Nome Paciente')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('medico.funcionario.user.name')
                    ->label('Nome Médico')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tipoTratamento.nome')
                    ->label('Tipo de tratamento')
                    ->sortable(),
                Tables\Columns\TextColumn::make('data')
                    ->dateTime('d/m/Y H:i')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('sessoes')
                    ->label('Sessões')
                    ->numeric()
                    ->sortable(),
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
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->url(fn (Tratamento $record): string => TratamentoResource::getUrl('view', [$record])),
            ]);
    }
}
