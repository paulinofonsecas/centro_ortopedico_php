<?php

namespace App\Filament\Medico\Resources\PacienteResource\RelationManagers;

use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class ConsultasRelationManager extends RelationManager
{
    protected static string $relationship = 'consultas';

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                TextEntry::make('data_consulta')
                    ->dateTime('d/m/Y')
                    ->size(TextEntry\TextEntrySize::Large)
                    ->label('Data da consulta'),
                TextEntry::make('estadoConsulta.name')
                    ->size(TextEntry\TextEntrySize::Large)
                    ->label('Estado da consulta')
                    ->badge()
                    ->color(fn ($state): string => match ($state) {
                        'Pendente' => 'warning',
                        'Em andamento' => 'info',
                        'Concluido' => 'success',
                        'Cancelado' => 'danger',
                    }),
                TextEntry::make('medico.funcionario.user.name')
                    ->size(TextEntry\TextEntrySize::Large)
                    ->columnSpanFull()
                    ->label('Médico responsável'),
                TextEntry::make('created_at')
                    ->dateTime('d/m/Y H:i:s')
                    ->size(TextEntry\TextEntrySize::Large)
                    ->label('Data de cadastro'),
                TextEntry::make('updated_at')
                    ->dateTime('d/m/Y H:i:s')
                    ->size(TextEntry\TextEntrySize::Large)
                    ->label('Data da ultima atualização'),
            ])->columns(2);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('paciente')
            ->columns([
                Tables\Columns\TextColumn::make('medico.funcionario.user.name')
                    ->label('Médico responsável')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('data_consulta')
                    ->label('Data da consulta')
                    ->dateTime('d/m/Y H:i')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('estadoConsulta.name')
                    ->badge()
                    ->color(fn ($state): string => match ($state) {
                        'Pendente' => 'warning',
                        'Em andamento' => 'info',
                        'Concluido' => 'success',
                        'Cancelado' => 'danger',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Data registro')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
}
