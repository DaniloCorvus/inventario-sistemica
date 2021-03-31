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
use Illuminate\Http\Resources\Json\JsonResource;

class clienteResponse extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toResponse($request)
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

        return view(
            'admin.clientes.index',
            compact(
                'typereparacions',
                'clientes',
                'users',
                'marcas',
                'descripciones',
                'estados',
                'modos',
                'tipos',
                'razons'
            )
        );
    }

    public function services($cliente)
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

        return view('admin.clientes.services', compact('cliente','equipos', 'marcas', 'descripciones', 'clientes', 'users', 'equipos', 'estados', 'modos', 'tipos', 'razons'));
    }
}
