<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RecepcionistaResource\Pages\CreateRecepcionista;
use App\Filament\Resources\RecepcionistaResource\Pages\EditRecepcionista;
use App\Filament\Resources\RecepcionistaResource\Pages\ListRecepcionistas;
use App\Models\Municipio;
use App\Models\Provincia;
use App\Models\Recepcionista;
use App\Models\EstadoDaConta;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Table;

class RecepcionistaResource extends Resource
{
    protected static ?string $model = Recepcionista::class;

    protected static ?string $navigationIcon = 'healthicons-f-i-exam-multiple-choice';

    protected static ?string $navigationGroup = 'contas';

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

                    ]),

                Section::make()
                    ->schema([
                        Select::make('funcionario.estadoDaConta.id')
                            ->label('Estado da conta')
                            ->options(EstadoDaConta::all()->pluck('nome', 'id'))
                            ->searchable(),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        /*
         * nome
         * email
         * telefone
         * Estado da conta
         * data de criacao
         */
        return $table
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('id')
                    ->label('ID'),
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
                BadgeColumn::make('funcionario.estadoDaConta.nome')
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListRecepcionistas::route('/'),
            'create' => CreateRecepcionista::route('/create'),
            'edit' => EditRecepcionista::route('/{record}/edit'),
        ];
    }
}
