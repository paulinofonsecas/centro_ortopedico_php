<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Consulta extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'paciente_id',
        'medico_id',
        'data_consulta',
        'observacao',
        'estado_consulta_id',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll();
    }

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }

    public function medico()
    {
        return $this->belongsTo(Medico::class);
    }

    public function sintomas()
    {
        return $this->belongsToMany(Sintoma::class, 'r_consulta_sintomas', 'consulta_id', 'sintoma_id');
    }

    public function estadoConsulta()
    {
        return $this->belongsTo(EstadoConsulta::class);
    }
}
