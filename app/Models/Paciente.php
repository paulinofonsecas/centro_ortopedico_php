<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome_completo',
        'bi',
        'nascimento',
        'telefone',
        'profissao',
        'genero_id',
        'provincia_id',
        'municipio_id',
        'endereco',
    ];

    public function genero()
    {
        return $this->belongsTo(Genero::class);
    }

    public function provincia()
    {
        return $this->belongsTo(Provincia::class);
    }

    public function municipio()
    {
        return $this->belongsTo(Municipio::class);
    }
}
