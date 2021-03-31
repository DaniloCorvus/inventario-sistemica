<?php

namespace App\Repository;

use App\Accion;
use App\Cliente;
use App\Order;
use App\User;

class OrderRepository
{

    public function tecnicos(): array
    {
        $this->tecnicos = array();
        $this->usuarios()->each(
            function ($user) {
                if ($user->hasRole('tecnico')) {
                    array_push($this->tecnicos, $user);
                }
            }
        );

        return $this->tecnicos;
    }

    public function clientes()
    {
        return Cliente::all();
    }

    public function usuarios()
    {
        return User::all();
    }

    public function acciones()
    {
        return Accion::all();
    }

    public function orders()
    {
        return Order::all();
    }
}
