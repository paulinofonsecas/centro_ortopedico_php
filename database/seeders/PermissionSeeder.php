<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $permissions = [
        //     // Permission::create(['name' => 'list-users']),
        //     // Permission::create(['name' => 'create-user']),
        //     // Permission::create(['name' => 'view-user']),
        //     // Permission::create(['name' => 'delete-user']),

        //     Permission::create(['name' => 'list-pacientes']),
        //     Permission::create(['name' => 'create-paciente']),
        //     Permission::create(['name' => 'view-paciente']),
        //     Permission::create(['name' => 'delete-paciente']),

        //     Permission::create(['name' => 'list-consultorios']),
        //     // Permission::create(['name' => 'create-consultorio']),
        //     Permission::create(['name' => 'view-consultorio']),
        //     // Permission::create(['name' => 'delete-consultorio']),

        //     Permission::create(['name' => 'list-doacao-utentes']),
        //     Permission::create(['name' => 'create-doacao-utente']),
        //     Permission::create(['name' => 'view-doacao-utente']),
        //     // Permission::create(['name' => 'delete-doacao-utente']),

        //     Permission::create(['name' => 'list-doacao-items']),
        //     // Permission::create(['name' => 'create-doacao-item']),
        //     Permission::create(['name' => 'view-doacao-item']),
        //     // Permission::create(['name' => 'delete-doacao-item']),

        //     // Permission::create(['name' => 'list-permissao-especialidades']),
        //     // Permission::create(['name' => 'create-permissao-especialidade']),
        //     // Permission::create(['name' => 'view-permissao-especialidade']),
        //     // Permission::create(['name' => 'delete-permissao-especialidade']),

        //     Permission::create(['name' => 'list-consultas']),
        //     Permission::create(['name' => 'create-consulta']),
        //     Permission::create(['name' => 'view-consulta']),
        //     // Permission::create(['name' => 'delete-consulta']),
        // ];

        $permissions = Permission::all();
        $role = Role::find(4);
        $role->syncPermissions($permissions);

        // Permission::create(['name' => 'gerar-relatorio']);

    }
}
