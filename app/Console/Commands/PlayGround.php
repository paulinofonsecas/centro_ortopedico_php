<?php

namespace App\Console\Commands;

use App\Models\Administrador;
use App\Models\Medico;
use App\Models\Recepcionista;
use App\Models\Role;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

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
        $recepcionista = Recepcionista::all();
        foreach ($recepcionista as $recepcionista) {
            $recepcionista->funcionario->user->password = Hash::make('password');
            $recepcionista->funcionario->user->save();
        }
    
        $medicos = Medico::all();
        foreach ($medicos as $medico) {
            $medico->funcionario->user->password = Hash::make('password');
            $medico->funcionario->user->save();
        }
    }
}
