<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserPermission extends Model
{
    use HasFactory;

    protected $table = 'model_has_permissions';

    protected $fillable = [
        'permission_id',
        'model_type',
        'model_id',
    ];

    public function addPermission()
    {
        return DB::insert('insert into model_has_permissions (permission_id, model_type, model_id) values (?, ?, ?)', [
            $this->permission_id,
            'App\Models\User',
            $this->user_id,
        ]);
    }
    
}
