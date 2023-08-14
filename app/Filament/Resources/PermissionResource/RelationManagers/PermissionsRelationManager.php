<?php

namespace App\Filament\Resources\PermissionResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use App\Models\Permission;
use App\Models\Role;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PermissionsRelationManager extends RelationManager
{
    protected static string $relationship = 'permissions';

    // protected function handleRecordCreation(array $data): Model
    // {
    //     dd($data);
    //     // $permission = Permission::create(['name' => $data['name']]);

    //     // $role = $this->ownerRecord;
    //     // $role->syncPermissions([$permission]);

    //     // return $permission;
    // }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('id')
                    ->required()
                    ->options(Permission::all()->pluck('name', 'id'))
                    ->searchable(),
            ]);
    }

    /**
     * Undocumented function
     *
     * @param Table $table
     * @return Table
     */
    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\Action::make('add_permission')
                    ->label('Adicioanar permissão')
                    ->form([
                        Forms\Components\Select::make('permission_id')
                            ->label('Permissões')
                            ->required()
                            ->options(Permission::all()->pluck('name', 'id'))
                            ->searchable(),
                    ])
                    ->action(function ($data) {
                        $role = Role::find($this->ownerRecord->id);
                        $permissionId = $data['permission_id'];
                        
                        if ($role->permissions()->where('id', $permissionId)->exists()) {
                            Notification::make()
                                ->title('Erro ao adicionar permissão')
                                ->warning()
                                ->send();
                        } else {
                            $permission = Permission::find($permissionId);
                            $role->permissions()->attach($permission);

                            Notification::make()
                                ->title('Saved successfully')
                                ->success()
                                ->send();
                        }
                    })

            ])
            ->actions([
                Tables\Actions\DeleteAction::make()
                    ->action(function ($record) {
                        $role = Role::find($this->ownerRecord->id);

                        $role->permissions()->detach($record);
                    }),
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
}
