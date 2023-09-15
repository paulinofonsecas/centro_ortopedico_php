<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoDaConta extends Model
{
    use HasFactory;

    const ACTIVA = 1;
    const INACTIVA = 2;

    protected $fillable = [
        'nome',
    ];
}
