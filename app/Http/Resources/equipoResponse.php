<?php

namespace App\Http\Resources;

use App\Cliente;
use App\Equipo;
use App\Estado;
use App\Marca;
use App\Modo;
use App\Producto;
use App\Razon;
use App\Reparacion;
use App\Tipo;
use App\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Resources\Json\JsonResource;

class equipoResponse extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */

    public function toResponse($request, $vista = 'index'): View
    {
        $clientes = Cliente::toBase()->get();
        $users = User::toBase()->get();
        $equipos = Equipo::toBase()->get();
        $estados = Estado::toBase()->get();
        $modos = Modo::toBase()->get();
        $tipos = Tipo::toBase()->get();
        $razons = Razon::toBase()->get();
        $marcas = Marca::toBase()->get();
        $descripciones = Producto::toBase()->get();
        $typereparacions = Reparacion::toBase()->get();

        if ($vista == 'index') {
            return view('admin.equipos.index', compact('clientes', 'descripciones', 'typereparacions', 'users', 'equipos', 'marcas', 'estados', 'modos', 'tipos', 'razons'));
        }
        return view('admin.equipos.services', compact('equipo', 'marcas', 'descripciones', 'clientes', 'users', 'equipos', 'estados', 'modos', 'tipos', 'razons'));
    }
}
