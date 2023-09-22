<?php

namespace App\Filament\Medico\Resources;

use App\Filament\Medico\Resources\ConsultaResource\Pages;
use App\Filament\Medico\Resources\ConsultaResource\Pages\ProcessarConsulta;
use App\Models\Consulta;
use App\Models\EstadoConsulta;
use App\Models\Gravidade;
use App\Models\Medico;
use App\Models\Paciente;
use Filament\Actions\ActionGroup;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Actions;
use Filament\Infolists\Components\Fieldset;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Panel;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\RouteFacade;

class ConsultaResource extends Resource
{
    protected static ?string $model = Consulta::class;

    protected static ?string $navigationIcon = 'healthicons-o-cardiogram-e';

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                \Filament\Infolists\Components\Section::make('Informações da consulta')
                    ->collapsible()
                    ->schema([
                        TextEntry::make('data_consulta')
                            ->dateTime('d/m/Y')
                            ->size(TextEntry\TextEntrySize::Large)
                            ->label('Data da consulta'),
                        TextEntry::make('estadoConsulta.name')
                            ->size(TextEntry\TextEntrySize::Large)
                            ->label('Estado da consulta')
                            ->badge()
                            ->color(fn ($state): string => match ($state) {
                                'Pendente' => 'warning',
                                'Em andamento' => 'info',
                                'Concluido' => 'success',
                                'Cancelado' => 'danger',
                            }),
                        TextEntry::make('medico.funcionario.user.name')
                            ->size(TextEntry\TextEntrySize::Large)
                            ->columnSpanFull()
                            ->label('Médico responsável'),
                        TextEntry::make('created_at')
                            ->dateTime('d/m/Y H:i:s')
                            ->size(TextEntry\TextEntrySize::Large)
                            ->label('Data de cadastro'),
                        TextEntry::make('updated_at')
                            ->dateTime('d/m/Y H:i:s')
                            ->size(TextEntry\TextEntrySize::Large)
                            ->label('Data da ultima atualização'),
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
                Forms\Components\Section::make('Processar')
                    ->collapsible()
                    ->schema([
                        Forms\Components\Select::make('estado_consulta_id')
                            ->label('Estado da consulta')
                            ->required()
                            ->searchable()
                            ->options(function ($record) {
                                // $estadoConstulaId = $record->estado_consulta_id;
                                $result = EstadoConsulta::all()->pluck('name', 'id');

                                // if ($estadoConstulaId == EstadoConsulta::PENDENTE) {
                                //     $result->forget(EstadoConsulta::CONCLUIDA);
                                // }

                                return $result;
                            }),
                        Forms\Components\Section::make('avaliacao')
                            ->label('Avaliação')
                            ->schema([
                                \Filament\Forms\Components\Actions\ActionContainer::make(
                                    \Filament\Forms\Components\Actions\Action::make('Adicionar ficha de avaliação')
                                        ->url(function ($record) {
                                            $consultaId = $record->id;
                                            
                                            return FichaAvaliacaoResource::getUrl('create', [
                                                'consulta_id' => $consultaId,
                                            ]);
                                        })
                                ),
                            ]),
                    ]),
                Forms\Components\Section::make('Consulta')
                    ->collapsible()
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
                        \Filament\Forms\Components\Section::make('Endereço')
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
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('data_consulta', 'asc')
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
                Tables\Columns\TextColumn::make('estadoConsulta.name')
                    ->badge()
                    ->color(fn ($state): string => match ($state) {
                        'Pendente' => 'warning',
                        'Em andamento' => 'info',
                        'Concluido' => 'success',
                        'Cancelado' => 'danger',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Data registro')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Ultima atualização')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Filter::make('Pendentes')
                    ->query(fn (Builder $query): Builder => $query->where('estado_consulta_id', EstadoConsulta::PENDENTE)),
                Filter::make('Em andamento')
                    ->query(fn (Builder $query): Builder => $query->where('estado_consulta_id', EstadoConsulta::EM_ANDAMENTO)),
                Filter::make('Concluídas')
                    ->query(fn (Builder $query): Builder => $query->where('estado_consulta_id', EstadoConsulta::CONCLUIDA)),
                Filter::make('Canceladas')
                    ->query(fn (Builder $query): Builder => $query->where('estado_consulta_id', EstadoConsulta::CANCELADA)),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListConsultas::route('/'),
            'create' => Pages\CreateConsulta::route('/create'),
            'edit' => Pages\EditConsulta::route('/{record}/edit'),
            'view' => Pages\ViewConsulta::route('/{record}'),
            // 'processar' => ProcessarConsulta::getUrl(['{record}','processar']),
        ];
    }
}
