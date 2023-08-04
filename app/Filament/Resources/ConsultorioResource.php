<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ConsultorioResource\Pages;
use App\Models\Consultorio;
use App\Models\Medico;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ConsultorioResource extends Resource
{
    protected static ?string $model = Consultorio::class;

    protected static ?string $navigationIcon = 'healthicons-f-stethoscope';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Descrição do consultório')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('localizacao')
                    ->label('Localização do consultório')
                    ->required()
                    ->maxLength(255),
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
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Descrição do consultório')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('localizacao')
                    ->label('Localização')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('medico.funcionario.user.name')
                    ->label('Médico responsável')
                    // ->visible(fn ($record) => $record->medico_id != null)
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
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
            'index' => Pages\ManageConsultorios::route('/'),
        ];
    }
}
