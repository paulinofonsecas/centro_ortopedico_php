<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RConsultaSintoma extends Model
{
    use HasFactory;

    protected $fillable = [
        'consulta_id',
        'sintoma_id',
    ];
}
