<?php

namespace App\Filament\App\Resources;

use App\Filament\App\Resources\ConsultaResource\Pages;
use App\Models\Consulta;
use App\Models\Gravidade;
use App\Models\Medico;
use App\Models\Paciente;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ConsultaResource extends Resource
{
    protected static ?string $model = Consulta::class;

    protected static ?string $navigationIcon = 'healthicons-o-cardiogram-e';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('paciente_id')
                    ->label('Paciente')
                    ->options(Paciente::all()->pluck('nome_completo', 'id'))
                    ->required()
                    ->searchable(),
                Select::make('medico_id')
                    ->label('Médico responsavel')
                    ->options(function () {
                        $medicos = Medico::all();
                        $saida = [];

                        foreach ($medicos as $medico) {
                            $saida[$medico->id] = $medico->funcionario->user->name;
                        }

                        return $saida;
                    })->required()
                    ->searchable(),
                Forms\Components\DateTimePicker::make('data_consulta')
                    ->required(),
                Section::make('sintomas')
                    ->label('Sintomas (Optional)')
                    ->description('Sintomas do paciente')
                    ->schema([
                        \Filament\Forms\Components\Grid::make(2)
                            ->schema([
                                \Filament\Forms\Components\TextInput::make('sintoma1')
                                ->label('Sintoma 1'),
                                Select::make('gravidade1')
                                    ->dehydrated(fn (\Filament\Forms\Get $get): bool => filled($get('sintoma1')))
                                    ->label('Gravidade')
                                    ->searchable()
                                    ->required(fn (\Filament\Forms\Get $get): bool => filled($get('sintoma1')))
                                    ->options(Gravidade::all()->pluck('name', 'id'))
                            ]),
                        \Filament\Forms\Components\Grid::make(2)
                            ->schema([
                                \Filament\Forms\Components\TextInput::make('sintoma2')
                                ->label('Sintoma 2'),
                                Select::make('gravidade2')
                                    ->dehydrated(fn (\Filament\Forms\Get $get): bool => filled($get('sintoma2')))
                                    ->label('Gravidade')
                                    ->searchable()
                                    ->required(fn (\Filament\Forms\Get $get): bool => filled($get('sintoma2')))
                                    ->options(Gravidade::all()->pluck('name', 'id'))
                            ]),
                        \Filament\Forms\Components\Grid::make(2)
                            ->schema([
                                \Filament\Forms\Components\TextInput::make('sintoma3')
                                ->label('Sintoma 3'),
                                Select::make('gravidade3')
                                    ->dehydrated(fn (\Filament\Forms\Get $get): bool => filled($get('sintoma3')))
                                    ->label('Gravidade')
                                    ->searchable()
                                    ->required(fn (\Filament\Forms\Get $get): bool => filled($get('sintoma3')))
                                    ->options(Gravidade::all()->pluck('name', 'id'))
                            ]),
                    ]),
                Forms\Components\Textarea::make('observacao')
                    ->maxLength(65535)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
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
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListConsultas::route('/'),
            'create' => Pages\CreateConsulta::route('/create'),
            'edit' => Pages\EditConsulta::route('/{record}/edit'),
        ];
    }
}
