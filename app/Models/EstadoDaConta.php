<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class EstadoDaConta extends Model
{
    use HasFactory, LogsActivity;

    const ACTIVA = 1;
    const INACTIVA = 2;

    protected $fillable = [
        'nome',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll();
    }
}
