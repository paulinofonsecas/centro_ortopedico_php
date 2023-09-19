<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Utente extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $fillable = [
        'name',
        'bi',
        'telefone',
        'nascimento',
        'nome_pai',
        'nome_mae',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll();
    }
}
