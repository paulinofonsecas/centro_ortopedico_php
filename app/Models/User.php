<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens, HasFactory, Notifiable, HasPermissions, HasRoles, LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'password_reset_required',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'email']);
    }

    public function isActive() {
        return $this->funcionario->estado_da_conta_id === EstadoDaConta::ACTIVA;
    }

    public function bloquear()
    {
        $this->funcionario->estado_da_conta_id = EstadoDaConta::INACTIVA;
        $this->funcionario->save();
    }

    public function desbloquear()
    {
        $this->funcionario->estado_da_conta_id = EstadoDaConta::ACTIVA;
        $this->funcionario->save();
    }

    public function funcionario()
    {
        return $this->hasOne(Funcionario::class);
    }

    public function canAccessPanel($role): bool
    {
        return true;
    }

    public function canUserAccessPanel($role): bool
    {
        return $this->hasRole($role);
    }

    public function isRecepcionista()
    {
        return $this->hasRole('recepcionista');
    }

    public function resetPassword($novaSenha)
    {
        $this->password = Hash::make($novaSenha);
        $this->password_reset_required = false;
        $this->save();
    }
}
