<?php

namespace App\Traits;

use Illuminate\Support\Facades\Hash;

trait MyCanResetPassword
{
    public function resetPassword($novaSenha)
    {
        $this->password = Hash::make($novaSenha);
        $this->password_reset_required = true;
        $this->save();
    }
    
}