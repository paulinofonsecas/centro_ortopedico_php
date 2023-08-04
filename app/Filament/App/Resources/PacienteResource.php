<?php

namespace App\Filament\App\Resources;

use App\Filament\App\Resources\PacienteResource\Pages;
use App\Filament\App\Resources\PacienteResource\RelationManagers;
use App\Models\Genero;
use App\Models\Municipio;
use App\Models\Paciente;
use App\Models\Provincia;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Select;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PacienteResource extends Resource
{
    protected static ?string $model = Paciente::class;

    protected static ?string $navigationIcon = 'healthicons-f-i-groups-perspective-crowd';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nome_completo')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('bi')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('nascimento')
                    ->required(),
                Forms\Components\TextInput::make('telefone')
                    ->tel()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('profissao')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('endereco')
                    ->required()
                    ->maxLength(255),

                Select::make('provincia_id')
                    ->label('Provincia')
                    ->options(Provincia::query()->pluck('nome', 'id'))
                    ->searchable(),
                Select::make('genero_id')
                    ->label('Gênero')
                    ->options(Genero::query()->pluck('name', 'id'))
                    ->searchable(),
                Select::make('municipio_id')
                    ->label('Município')
                    ->options(Municipio::query()->pluck('nome', 'id'))
                    ->searchable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nome_completo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('bi')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nascimento')
                    ->date('d/m/Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('genero.name')
                        ->numeric()
                        ->sortable(),
                Tables\Columns\TextColumn::make('telefone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('profissao')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('provincia.nome')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('municipio.nome')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('endereco')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Cadastrado em')
                    ->dateTime('d/m/Y H:i')
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
            'index' => Pages\ListPacientes::route('/'),
            'create' => Pages\CreatePaciente::route('/create'),
            'edit' => Pages\EditPaciente::route('/{record}/edit'),
        ];
    }
}
