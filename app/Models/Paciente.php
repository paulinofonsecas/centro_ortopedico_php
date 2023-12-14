<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Paciente extends Model
{
    use HasFactory;
    use LogsActivity;

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

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll();
    }

    public function consultas()
    {
        return $this->hasMany(Consulta::class);
    }

    public function tratamentos()
    {
        return $this->hasMany(Tratamento::class);
    }

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
