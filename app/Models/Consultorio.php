<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Consultorio extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'name',
        'localizacao',
        'medico_id',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll();
    }

    public function medico()
    {
        return $this->belongsTo(Medico::class);
    }

}
