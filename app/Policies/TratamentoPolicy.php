<?php

namespace App\Policies;

use App\Models\Tratamento;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TratamentoPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Tratamento $tratamento): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasRole(['tecnico']);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Tratamento $tratamento): bool
    {
        return $user->hasRole(['tecnico']);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Tratamento $tratamento): bool
    {
        return $user->hasRole(['admin', 'admin']);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Tratamento $tratamento): bool
    {
        return $user->hasRole(['admin', 'admin']);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Tratamento $tratamento): bool
    {
        return $user->hasRole(['admin', 'admin']);
    }
}
