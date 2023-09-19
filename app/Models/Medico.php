<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Medico extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'funcionario_id',
        'especialidade_id',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll();
    }

    public function consultas()
    {
        return $this->hasMany(Consulta::class);
    }

    public function funcionario()
    {
        return $this->belongsTo(Funcionario::class);
    }

    public function especialidade()
    {
        return $this->belongsTo(Especialidade::class);
    }
}
