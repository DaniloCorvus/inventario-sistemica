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
use App\Services\ResponseService;
use App\Tipo;
use App\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */

    public function toResponse($request, $vista = 'index'): View
    {
        $aux = new  ResponseService();

        $services = $aux->index();

        $clientes = Cliente::OrderBy('nombre', 'Asc')->toBase()->get(['nombre', 'apellido', 'identificacion', 'id']);
        $users = User::OrderBy('name', 'Asc')->toBase()->get(['name', 'id']);
        $equipos = Equipo::OrderBy('serie', 'Asc')->toBase()->get(['serie', 'id']);
        $estados = Estado::OrderBy('nombre', 'Asc')->toBase()->get(['nombre', 'id']);
        $modos = Modo::OrderBy('nombre', 'Asc')->toBase()->get(['nombre', 'id']);
        $tipos = Tipo::OrderBy('nombre', 'Asc')->toBase()->get(['nombre', 'id']);
        $razons = Razon::OrderBy('nombre', 'Asc')->toBase()->get(['nombre', 'id']);
        $marcas = Marca::OrderBy('nombre', 'Asc')->toBase()->get(['nombre', 'id']);
        $descripciones = Producto::OrderBy('nombre', 'Asc')->toBase()->get(['nombre', 'id']);
        $typereparacions = Reparacion::OrderBy('nombre', 'Asc')->toBase()->get(['nombre', 'id']);

        if ($vista == 'index') {
            return view('admin.services.index', compact('services', 'marcas', 'typereparacions', 'descripciones', 'clientes', 'users', 'equipos', 'estados', 'modos', 'tipos', 'razons'));
        }
        // return view('admin.equipos.services', compact('equipo', 'marcas', 'descripciones', 'clientes', 'users', 'equipos', 'estados', 'modos', 'tipos', 'razons'));
    }
}
