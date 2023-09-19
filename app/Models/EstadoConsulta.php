<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class EstadoConsulta extends Model
{
    use HasFactory, LogsActivity;

    const PENDENTE = 1;
    const EM_ANDAMENTO = 2;
    const CONCLUIDA = 3;
    const CANCELADA = 4;

    protected $fillable = [
        'name',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll();
    }
}
