<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Doacao extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $fillable = [
        'quantidade',
        'obs',
        'utente_id',
        'item_id',
        'estado_do_item_id',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll();
    }

    public function utente()
    {
        return $this->belongsTo(Utente::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function estadoDoItem()
    {
        return $this->belongsTo(EstadoDoItem::class);
    }
}
