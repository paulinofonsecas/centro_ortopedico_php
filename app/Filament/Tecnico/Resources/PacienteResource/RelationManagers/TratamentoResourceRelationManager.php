<?php

namespace App\Filament\Tecnico\Resources\PacienteResource\RelationManagers;

use App\Filament\Tecnico\Resources\TratamentoResource;
use App\Models\Paciente;
use App\Models\TipoTratamento;
use App\Models\Tratamento;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;


class TratamentoResourceRelationManager extends RelationManager
{
    protected static string $relationship = 'tratamentos';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('paciente.nome_completo')
                        ->label('Nome completo')
                        ->required()
                        ->maxLength(255),
                Forms\Components\TextInput::make('tecnico.funcionario.user.name')
                        ->label('Técnico')
                        ->required()
                        ->maxLength(255),
                Forms\Components\TextInput::make('peso')
                        ->label('Peso')
                        ->required()
                        ->maxLength(255),
                Forms\Components\TextInput::make('ta')
                        ->label('TA')
                        ->required()
                        ->maxLength(255),
                Forms\Components\Textarea::make('observacoes')
                    ->maxLength(6553)
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('paciente_id')
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('paciente.nome_completo')
                    ->label('Nome Paciente')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tecnico.funcionario.user.name')
                    ->label('Nome Tecnico')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('peso')
                    ->label('Peso')
                    ->searchable(),
                Tables\Columns\TextColumn::make('ta')
                    ->label('TA')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tipoTratamento.nome')
                    ->label('Tipo de tratamento')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d/m/Y H:i')
                    ->label('Data do tratamento')
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->headerActions([
                Tables\Actions\Action::make('create')
                    ->label('Criar tratamento')
                    ->icon('heroicon-o-plus')
                    ->url(TratamentoResource::getUrl('create'))
            ])
            ->filters([])
            ->actions([
            ]);
    }



    public function isReadOnly(): bool
    {
        return false;
    }
}
