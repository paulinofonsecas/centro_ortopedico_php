<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    use HasFactory;

    protected $fillable = [
        'paciente_id',
        'medico_id',
        'data_consulta',
        'observacao',
    ];

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
}
