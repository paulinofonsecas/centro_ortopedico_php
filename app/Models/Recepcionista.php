<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recepcionista extends Model
{
    use HasFactory;

    protected $fillable = [
        'funcionario_id',
    ];
    
    public function funcionario()
    {
        return $this->belongsTo(Funcionario::class);
    }
}
