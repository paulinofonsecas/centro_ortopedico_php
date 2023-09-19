<?php

namespace App\Filament\Medico\Resources;

use App\Filament\Medico\Resources\TratamentoResource\Pages\CreateTratamento;
use App\Filament\Medico\Resources\TratamentoResource\Pages\EditTratamento;
use App\Filament\Medico\Resources\TratamentoResource\Pages\ListTratamentos;
use App\Models\Paciente;
use App\Models\TipoTratamento;
use App\Models\Tratamento;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TratamentoResource extends Resource
{
    protected static ?string $model = Tratamento::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('hc')
                    ->label('HC')
                    ->numeric(),
                Forms\Components\Select::make('paciente_id')
                    ->label('Paciente')
                    ->options(Paciente::all()->pluck('nome_completo', 'id'))
                    ->required()
                    ->searchable(),
                Forms\Components\Select::make('tipo_tratamento_id')
                    ->label('Tipo de tratamento')
                    ->options(TipoTratamento::all()->pluck('nome', 'id'))
                    ->required()
                    ->searchable(),
                Forms\Components\DateTimePicker::make('data')
                    ->label('Data e hora')
                    ->required(),
                Forms\Components\TextInput::make('sessoes')
                    ->label('Sessões')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('ta')
                        ->label('TA')
                        ->required()
                        ->maxLength(255),
                Forms\Components\Textarea::make('observacoes')
                    ->maxLength(65535)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
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
                Tables\Columns\TextColumn::make('ta')
                    ->label('TA')
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
            'index' => ListTratamentos::route('/'),
            'create' => CreateTratamento::route('/create'),
            'edit' => EditTratamento::route('/{record}/edit'),
        ];
    }    
}
