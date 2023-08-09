<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doacao extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantidade',
        'obs',
        'utente_id',
        'item_id',
        'estado_do_item_id',
    ];
}
