<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Recepcionista extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'funcionario_id',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll();
    }
    
    public function funcionario()
    {
        return $this->belongsTo(Funcionario::class);
    }

    public function permissions()
    {
        return $this->funcionario()->user()->getChild()->permissions();
    }
}
