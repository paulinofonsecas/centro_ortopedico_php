<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class TestUserRoles extends Command
{



    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-user-roles';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        DB::beginTransaction();
        $user = User::create([
            'name' => 'Test User',
            'email' => 't@t.com',
            'password' => bcrypt('secret'),
        ]);
        // Criar um papel (role)
        $role = Role::create(['name' => 'admin']);

        // Atribuir um papel ao usuário
        $user->assignRole('admin');

        // Verificar se o usuário tem um papel específico
        if ($user->hasRole('admin')) {
            echo 'Usuário tem papel';
        }

        // Dar permissão ao papel
        $permission = Permission::create(['name' => 'editar posts']);
        $role->givePermissionTo($permission);

        // Verificar se o usuário tem uma permissão específica
        if ($user->hasPermissionTo('editar posts')) {
            echo 'Usuário tem permissão';
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
