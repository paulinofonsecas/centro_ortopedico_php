<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoConsulta extends Model
{
    use HasFactory;

    const PENDENTE = 1;
    const EM_ANDAMENTO = 2;
    const CONCLUIDA = 3;
    const CANCELADA = 4;

    protected $fillable = [
        'name',
    ];
}
