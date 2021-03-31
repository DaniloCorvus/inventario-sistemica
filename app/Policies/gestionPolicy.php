<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class gestionPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function get(User $user)
    {
        if ($user->hasRole('admin')) {
            return true;
        }
    }

    public function gerencia(User $user)
    {
        if ($user->hasRole('Gerencia')) {
            return true;
        }
    }
}
