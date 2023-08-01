<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class PlayGround extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'play';

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
        $user = User::create([
            'name' => 'Paulino Fonseca',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
        ]);

        $user->givePermissionTo('edit articles');

        echo $user->can('edit articles');

        $user->delete();
    }
}
