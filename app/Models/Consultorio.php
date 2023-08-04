<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultorio extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'localizacao',
        'medico_id',
    ];

    public function medico()
    {
        return $this->belongsTo(Medico::class);
    }

}
