<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    use HasFactory;

    protected $fillable = [
        'telefone',
        'user_id',
        'endereco_id',
        'estado_da_conta_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function estadoDaConta()
    {
        return $this->belongsTo(EstadoDaConta::class, 'estado_da_conta_id', 'id');
    }

    public function endereco()
    {
        return $this->belongsTo(Endereco::class, 'endereco_id', 'id');
    }
}
