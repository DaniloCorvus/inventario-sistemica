<?php

namespace App\Observers;

use App\Cliente;

class ClienteObserver
{
    public function updating(Cliente $cliente)
    {
        // if (!request()->has('accept')) {
        //     $cliente->accept = null;
        // }
    }
}
