<?php

namespace App\Filament\Medico\Resources;

use App\Filament\Medico\Resources\PacienteResource\Pages;
use App\Filament\Medico\Resources\PacienteResource\RelationManagers\ConsultasRelationManager;
use App\Filament\Medico\Resources\PacienteResource\RelationManagers\TratamentoResourceRelationManager;
use App\Models\Genero;
use App\Models\Municipio;
use App\Models\Paciente;
use App\Models\Provincia;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Infolists\Components\Fieldset;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PacienteResource extends Resource
{
    protected static ?string $model = Paciente::class;

    protected static ?string $navigationIcon = 'healthicons-f-i-groups-perspective-crowd';

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                \Filament\Infolists\Components\Section::make('Informações do paciente')
                    ->collapsible()
                    ->schema([
                        TextEntry::make('nome_completo')
                            ->size(TextEntry\TextEntrySize::Large)
                            ->label('Nome completo'),
                        TextEntry::make('bi')
                            ->size(TextEntry\TextEntrySize::Large)
                            ->label('BI'),
                        TextEntry::make('nascimento')
                            ->size(TextEntry\TextEntrySize::Large)
                            ->dateTime('d/m/Y')
                            ->label('Data de nascimento'),
                        TextEntry::make('telefone')
                            ->size(TextEntry\TextEntrySize::Large)
                            ->numeric(thousandsSeparator: ' ')
                            ->label('Telefone'),
                        TextEntry::make('profissao')
                            ->size(TextEntry\TextEntrySize::Large)
                            ->label('Profissão'),
                        TextEntry::make('genero.name')
                            ->size(TextEntry\TextEntrySize::Large)
                            ->label('Genero'),
                        Fieldset::make('Localização')
                            ->schema([
                                TextEntry::make('provincia.nome')
                                    ->label('Provincia')
                                    ->size(TextEntry\TextEntrySize::Large),
                                TextEntry::make('municipio.nome')
                                    ->label('Municipio')
                                    ->size(TextEntry\TextEntrySize::Large),
                                TextEntry::make('endereco')
                                    ->size(TextEntry\TextEntrySize::Large),
                            ])->columns(2),
                    ])->columns(2),
            ]);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nome_completo')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('bi')
                    ->maxLength(255),
                Forms\Components\DatePicker::make('nascimento')
                    ->required(),
                Forms\Components\TextInput::make('telefone')
                    ->tel()
                    ->maxLength(255),
                Forms\Components\TextInput::make('profissao')
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
                    ->required()
                    ->options(Genero::query()->pluck('name', 'id'))
                    ->searchable(),
                Select::make('municipio_id')
                    ->label('Município')
                    ->options(function (Get $get) {
                        $provincia_id = $get('provincia_id'); // Store the value of the `email` field in the `$email` variable.

                        if (!$provincia_id) {
                            return Municipio::all()->pluck('nome', 'id');
                        }

                        $munis = Municipio::where('provincia_id', '=', $provincia_id)->pluck('nome', 'id');

                        return $munis;
                    })
                            ->searchable()
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
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            ConsultasRelationManager::class,
            TratamentoResourceRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPacientes::route('/'),
            'create' => Pages\CreatePaciente::route('/create'),
            'edit' => Pages\EditPaciente::route('/{record}/edit'),
            'view' => Pages\ViewPaciente::route('/{record}'),
        ];
    }
}
