<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AdministradorResource\Pages\CreateAdministrador;
use App\Filament\Resources\AdministradorResource\Pages\EditAdministrador;
use App\Filament\Resources\AdministradorResource\Pages\ListAdministradors;
use App\Models\EstadoDaConta;
use App\Models\Administrador;
use App\Models\Municipio;
use App\Models\Provincia;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Rmsramos\Activitylog\RelationManagers\ActivitylogRelationManager;

class AdministradorResource extends Resource
{
    protected static ?string $model = Administrador::class;

    protected static ?string $navigationIcon = 'clarity-administrator-solid';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        TextInput::make('user.name')
                            ->label('Nome completo'),
                        TextInput::make('user.email')
                            ->required()
                            ->label('Email'),
                        TextInput::make('user.password')
                            ->password()
                            ->label('Senha')
                            ->minLength(8)
                            ->required()
                            ->visibleOn('create'),
                    ]),

                Section::make()
                    ->schema([
                        TextInput::make('funcionario.telefone')
                            ->label('Telefone')
                            ->required(),

                        Select::make('endereco.provincia_id')
                            ->label('Provincia')
                            ->options(Provincia::all()->pluck('nome', 'id'))
                            ->searchable(),

                        Select::make('endereco.municipio_id')
                            ->label('Municipio')
                            ->options(function (\Filament\Forms\Get $get) {
                                $provincia_id = $get('endereco.provincia_id'); // Store the value of the `email` field in the `$email` variable.

                                if (!$provincia_id) {
                                    return Municipio::all()->pluck('nome', 'id');
                                }

                                $munis = Municipio::where('provincia_id', '=', $provincia_id)->pluck('nome', 'id');
                                return $munis;
                            })
                            ->searchable(),

                        TextInput::make('endereco.rua')
                            ->label('Rua'),
                        Select::make('funcionario.estado_da_conta_id')
                            ->label('Estado da conta')
                            ->options(EstadoDaConta::all()->pluck('nome', 'id'))
                            ->searchable(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('funcionario.user.name')
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('funcionario.user.name')
                    ->label('Nome completo')
                    ->searchable()
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('funcionario.user.email')
                    ->label('Email')
                    ->searchable()
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('funcionario.telefone')
                    ->label('Telefone')
                    ->searchable()
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('funcionario.estadoDaConta.nome')
                    ->badge()
                    ->label('Estado da conta')
                    ->colors([
                        'success' => 'Activa',
                        'danger' => 'Inativa',
                        'warning' => 'Desactivada',
                    ]),
                \Filament\Tables\Columns\TextColumn::make('created_at')
                    ->sortable()
                    ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                \Filament\Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                \Filament\Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            ActivitylogRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAdministradors::route('/'),
            'create' => CreateAdministrador::route('/create'),
            'edit' => EditAdministrador::route('/{record}/edit'),
        ];
    }
}
