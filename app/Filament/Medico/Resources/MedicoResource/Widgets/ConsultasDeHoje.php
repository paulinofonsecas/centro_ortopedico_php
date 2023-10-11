<?php

namespace App\Filament\Medico\Resources\MedicoResource\Widgets;

use App\Filament\Medico\Resources\ConsultaResource;
use App\Models\Consulta;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class ConsultasDeHoje extends BaseWidget
{
    protected int|string|array $columnSpan = 'full';
    public function table(Table $table): Table
    {
        return $table
            ->query(
                Consulta::all()->toQuery()
            )
            ->filters([
                    Filter::make('para_mim')
                        ->query(function (Builder $query): Builder {
                            $user = auth()->user();
                            $query->where('medico_id', $user->id);

                            return $query;
                        })->default(),
                        SelectFilter::make('estado_consulta_id')
                            ->label('Estado da consulta')
                            ->options([
                                '1' => 'Pendente',
                                '2' => 'Em andamento',
                                '3' => 'Concluida',
                                '4' => 'Cancelada',
                            ]),
                ])
            ->columns([
                Tables\Columns\TextColumn::make('paciente.nome_completo')
                    ->label('Nome completo')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('medico.funcionario.user.name')
                    ->label('Médico responsável')
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
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Ultima atualização')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->url(fn (Consulta $record): string => ConsultaResource::getUrl('view', ['record' => $record])),
                Tables\Actions\EditAction::make()
                    ->url(fn (Consulta $record): string => ConsultaResource::getUrl('edit', ['record' => $record])),
            ]);
    }
}
