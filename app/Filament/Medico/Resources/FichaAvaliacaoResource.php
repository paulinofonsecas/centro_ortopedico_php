<?php

namespace App\Filament\Medico\Resources;

use App\Filament\Medico\Resources\FichaAvaliacaoResource\Pages;
use App\Models\FichaAvaliacao;
use Filament\Forms;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class FichaAvaliacaoResource extends Resource
{
    protected static ?string $model = FichaAvaliacao::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Forms\Components\TextInput::make('paciente_id')
                //     ->required()
                //     ->numeric(),
                Forms\Components\TextInput::make('id_hc')
                    ->required()
                    ->numeric(),
                Wizard::make([
                    Wizard\Step::make('Paciente')
                        ->schema([
                            Forms\Components\Textarea::make('alergias')
                                ->required()
                                ->maxLength(65535)
                                ->columnSpanFull(),
                            Forms\Components\Textarea::make('quixas_principais')
                                ->required()
                                ->maxLength(65535)
                                ->columnSpanFull(),
                            Forms\Components\Textarea::make('app')
                                ->required()
                                ->maxLength(65535)
                                ->columnSpanFull(),
                            Forms\Components\Textarea::make('apf')
                                ->required()
                                ->maxLength(65535)
                                ->columnSpanFull(),
                            Forms\Components\TextInput::make('peso')
                                ->required()
                                ->numeric(),
                            Forms\Components\Textarea::make('hda')
                                ->required()
                                ->maxLength(65535)
                                ->columnSpanFull(),
                        ]),
                    Wizard\Step::make('Exame Fisico')
                        ->schema([
                            Forms\Components\Textarea::make('estado_geral')
                                ->required()
                                ->maxLength(65535)
                                ->columnSpanFull(),
                            Forms\Components\Textarea::make('marcha')
                                ->required()
                                ->maxLength(65535)
                                ->columnSpanFull(),
                            Forms\Components\Textarea::make('forca')
                                ->required()
                                ->maxLength(65535)
                                ->columnSpanFull(),
                            Forms\Components\Textarea::make('dor')
                                ->required()
                                ->maxLength(65535)
                                ->columnSpanFull(),
                            Forms\Components\Textarea::make('sensibilidade')
                                ->required()
                                ->maxLength(65535)
                                ->columnSpanFull(),
                            Forms\Components\Textarea::make('adm')
                                ->required()
                                ->maxLength(65535)
                                ->columnSpanFull(),
                            Forms\Components\Textarea::make('tonus_muscular')
                                ->required()
                                ->maxLength(65535)
                                ->columnSpanFull(),
                            Forms\Components\Toggle::make('equilibrio_estatico')
                        ]),
                    Wizard\Step::make('Diagnosticos')
                        ->schema([
                            Forms\Components\Textarea::make('indicacao_de_orteses')
                            ->required()
                            ->maxLength(65535)
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('diagnostico_clinico')
                            ->required()
                            ->maxLength(65535)
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('diagnostico_funcional')
                            ->required()
                            ->maxLength(65535)
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('prognostico_reabilitacao')
                            ->required()
                            ->maxLength(65535)
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('dependecias_avd')
                            ->required()
                            ->maxLength(65535)
                            ->columnSpanFull(),
                        ]),
                    ])
                        ->persistStepInQueryString('ficha-avaliacao')
                        ->submitAction(new \Illuminate\Support\HtmlString(\Illuminate\Support\Facades\Blade::render(<<<BLADE
                            <x-filament::button
                                type="submit"
                                size="sm"
                            >
                                Submit
                            </x-filament::button>
                        BLADE)))
                        ->columnSpanFull(),
            ]);
    }

    protected function saveMyData()
    {

    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('paciente_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('id_hc')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('peso')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('equilibrio_estatico')
                    ->boolean(),
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

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
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
            'index' => Pages\ListFichaAvaliacaos::route('/'),
            'create' => Pages\CreateFichaAvaliacao::route('/create/{consulta_id}'),
            'edit' => Pages\EditFichaAvaliacao::route('/{record}/edit'),
        ];
    }    
}
