<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RecepcionistaResource\Pages;
use App\Models\EstadoDaConta;
use App\Models\Municipio;
use App\Models\Provincia;
use App\Models\Recepcionista;
use App\Models\User;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Infolists\Components\Actions\Action;
use Filament\Infolists\Components\Fieldset;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;
use Rmsramos\Activitylog\RelationManagers\ActivitylogRelationManager;

class RecepcionistaResource extends Resource
{
    protected static ?string $model = Recepcionista::class;

    protected static ?string $navigationIcon = 'healthicons-f-i-exam-multiple-choice';

    protected static ?string $navigationGroup = 'contas';

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                \Filament\Infolists\Components\Section::make('Informações do usuário')
                    ->schema([
                        TextEntry::make('funcionario.user.name')
                            ->label('Nome completo')
                            ->size(TextEntry\TextEntrySize::Large),
                        TextEntry::make('funcionario.user.email')
                            ->label('Email')
                            ->size(TextEntry\TextEntrySize::Large),
                        TextEntry::make('funcionario.telefone')
                            ->label('Telefone')
                            ->size(TextEntry\TextEntrySize::Large),
                        TextEntry::make('funcionario.estadoDaConta.nome')
                            ->label('Estado da conta')
                            ->size(TextEntry\TextEntrySize::Large)
                            ->badge()
                            ->color(fn ($state): string => match ($state) {
                                'Activa' => 'success',
                                'Inativa' => 'warning',
                                'Desactivada' => 'danger',
                            }),
                        Fieldset::make('Localização')
                            ->schema([
                                TextEntry::make('funcionario.endereco.provincia.nome')
                                    ->label('Provincia')
                                    ->size(TextEntry\TextEntrySize::Large),
                                TextEntry::make('funcionario.endereco.municipio.nome')
                                    ->label('Municipio')
                                    ->size(TextEntry\TextEntrySize::Large),
                                TextEntry::make('funcionario.endereco.rua')
                                    ->size(TextEntry\TextEntrySize::Large),
                            ])->columns(2),
                    ])
                    ->collapsible()
                    ->columns(2),
                \Filament\Infolists\Components\Section::make('Segurança')
                    ->collapsed()
                    ->schema(
                        fn (Recepcionista $recepcionista): array => [
                        \Filament\Infolists\Components\Actions\ActionContainer::make(
                            Action::make('Resetar a senha do usuario')
                                ->color('info')
                                ->icon('heroicon-o-key')
                                ->form([
                                    TextInput::make('password')
                                        ->label('Nova senha')
                                        ->password()
                                        ->required(),
                                ])
                                ->action(function (Recepcionista $recepcionista, array $data) {
                                    $user = $recepcionista->funcionario->user;

                                    $newPassowrd = Hash::make($data['password']);
                                    $user->password = $newPassowrd;
                                    $user->save();

                                    Notification::make('resetPassword')
                                        ->title('Senha resetada')
                                        ->success()
                                        ->body('Senha resetada com sucesso!')
                                        ->send();
                                })
                                ->requiresConfirmation(),
                        ),
                        \Filament\Infolists\Components\Actions\ActionContainer::make(
                            RecepcionistaResource::getBloquearOuDesbloquearActionContainer($recepcionista),
                        ),
                        // \Filament\Infolists\Components\Actions\ActionContainer::make(
                        //     Action::make('Deletar o usuario')
                        //         ->color('danger')
                        //         ->requiresConfirmation(),
                        // ),
                    ]),
            ]);
    }

    public static function getBloquearOuDesbloquearActionContainer($recepcionista): Action
    {
        if (!$recepcionista->funcionario->user->isActive()) {
            return Action::make('Desbloquear o usuario')
                ->action(function (Recepcionista $recepcionista) {
                    /** @var User $user */
                    $user = $recepcionista->funcionario->user;
                    $user->desbloquear();

                    Notification::make('desbloquearUsuario')
                        ->title('Usuario desbloqueado')
                        ->success()
                        ->body('Usuario foi desbloqueado com sucesso!')
                        ->send();
                })
                ->color('success')
                ->requiresConfirmation();
        } else {
            return Action::make('Bloquear o usuario')
                ->action(function (Recepcionista $recepcionista) {
                    /** @var User $user */
                    $user = $recepcionista->funcionario->user;
                    $user->bloquear();

                    Notification::make('bloquearUsuario')
                        ->title('Usuario bloqueado')
                        ->success()
                        ->body('Usuario foi bloqueado com sucesso!')
                        ->send();
                })
                ->color('danger')
                ->requiresConfirmation();
        }
    }

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
                        Select::make('funcionario.estado_da_conta_id')
                            ->label('Estado da conta')
                            ->options(EstadoDaConta::all()->pluck('nome', 'id'))
                            ->searchable(),
                    ]),
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
            ->defaultSort('funcionario.user.name')
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
            ])
            ->actions([
                \Filament\Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListRecepcionistas::route('/'),
            'create' => Pages\CreateRecepcionista::route('/create'),
            'view' => Pages\ViewRecepcionista::route('/{record}'),
            'edit' => Pages\EditRecepcionista::route('/{record}/edit'),
        ];
    }
}
