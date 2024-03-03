<?php

namespace App\Filament\Tecnico\Resources;

use App\Filament\Tecnico\Resources\TratamentoResource\Pages\CreateTratamento;
use App\Filament\Tecnico\Resources\TratamentoResource\Pages\EditTratamento;
use App\Filament\Tecnico\Resources\TratamentoResource\Pages\ListTratamentos;
use App\Filament\Tecnico\Resources\TratamentoResource\Pages\ViewTratamento;
use App\Models\Paciente;
use App\Models\TipoTratamento;
use App\Models\Tratamento;

use DateTime;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\Fieldset;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TratamentoResource extends Resource
{
    protected static ?string $model = Tratamento::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                \Filament\Infolists\Components\Section::make('Informações do tratamento')
                    ->collapsible()
                    ->schema([
                        TextEntry::make('tecnico.funcionario.user.name')
                            ->label('Técnico')
                            ->size(TextEntry\TextEntrySize::Large),
                        TextEntry::make('tipoTratamento.nome')
                            ->label('Tipo de tratamento')
                            ->size(TextEntry\TextEntrySize::Large),
                        TextEntry::make('peso')
                            ->label('Peso')
                            ->size(TextEntry\TextEntrySize::Large),
                        TextEntry::make('ta')
                            ->label('TA')
                            ->size(TextEntry\TextEntrySize::Large),
                        TextEntry::make('created_at')
                            ->label('Data do tratamento')
                            ->size(TextEntry\TextEntrySize::Large),
                        TextEntry::make('updated_at')
                            ->label('Data da ultima atualização')
                            ->size(TextEntry\TextEntrySize::Large),
                    ])->columns(2),
                \Filament\Infolists\Components\Section::make('Informações do paciente')
                    ->collapsible()
                    ->schema([
                        TextEntry::make('paciente.nome_completo')
                            ->size(TextEntry\TextEntrySize::Large)
                            ->label('Nome completo'),
                        TextEntry::make('paciente.bi')
                            ->size(TextEntry\TextEntrySize::Large)
                            ->label('BI'),
                        TextEntry::make('paciente.nascimento')
                            ->size(TextEntry\TextEntrySize::Large)
                            ->dateTime('d/m/Y')
                            ->label('Data de nascimento'),
                        TextEntry::make('paciente.telefone')
                            ->size(TextEntry\TextEntrySize::Large)
                            ->numeric(thousandsSeparator: ' ')
                            ->label('Telefone'),
                        TextEntry::make('paciente.profissao')
                            ->size(TextEntry\TextEntrySize::Large)
                            ->label('Profissão'),
                        TextEntry::make('paciente.genero.name')
                            ->size(TextEntry\TextEntrySize::Large)
                            ->label('Genero'),
                        Fieldset::make('Localização')
                            ->schema([
                                TextEntry::make('paciente.provincia.nome')
                                    ->label('Provincia')
                                    ->size(TextEntry\TextEntrySize::Large),
                                TextEntry::make('paciente.municipio.nome')
                                    ->label('Municipio')
                                    ->size(TextEntry\TextEntrySize::Large),
                                TextEntry::make('paciente.endereco')
                                    ->size(TextEntry\TextEntrySize::Large)
                            ])->columns(2)
                    ])->columns(2),
            ]);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
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

    public static function table(Table $table): Table
    {
        return $table
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
                Tables\Actions\CreateAction::make()
                    ->label('Registar tratamento'),
            ]);
    }

    public static function getRelations(): array
    {
        return [
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTratamentos::route('/'),
            'create' => CreateTratamento::route('/create'),
            'edit' => EditTratamento::route('/{record}/edit'),
            'view' => ViewTratamento::route('/{record}'),
        ];
    }
}
