<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sintoma extends Model
{
    use HasFactory;

    protected $fillable = [
        'sintoma',
        'gravidade_id',
    ];

    public function gravidade()
    {
        return $this->belongsTo(Gravidade::class);
    }

}
