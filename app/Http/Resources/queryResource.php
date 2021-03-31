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
use App\Service;
use App\Services\ResponseService;
use App\Tipo;
use App\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Resources\Json\JsonResource;

class queryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */

    public function toResponse($request, $vista = 'index'): View
    {
        switch (request()->get('columna')) {
            case 'id':
                $services  = Service::with(
                    'cliente:id,nombre,apellido,identificacion,direccion',
                    'users:user_id,name',
                    'equipo:id,marca,modelo,serie',
                    'estado:id,nombre',
                    'equipo.marca:id,nombre',
                    'modo:id,nombre',
                    'tipo:id,nombre',
                    'razon:id,nombre'
                )->where('id', request()->get('filter'))
                    ->orderBy('created_at', 'Desc')->paginate(15);

                break;
            case 'radicado':
                $services  = Service::with(
                    'cliente:id,nombre,apellido,identificacion,direccion',
                    'users:user_id,name',
                    'equipo:id,marca,modelo,serie',
                    'estado:id,nombre',
                    'equipo.marca:id,nombre',
                    'modo:id,nombre',
                    'tipo:id,nombre',
                    'razon:id,nombre'
                )->where('radicado', request()->get('filter'))
                    ->orderBy('created_at', 'Desc')->paginate(15);
                $services->appends(['columna' => request()->get('columna'), 'filter' => request()->get('filter')]);
                break;

            case 'razon':
                $services  = Service::with(
                    'cliente:id,nombre,apellido,identificacion,direccion',
                    'users:user_id,name',
                    'equipo:id,marca,modelo,serie',
                    'estado:id,nombre',
                    'equipo.marca:id,nombre',
                    'modo:id,nombre',
                    'tipo:id,nombre',
                    'razon:id,nombre'
                )->whereHas('razon', function ($query) {
                    $query->where('nombre', 'like', '%' . request()->get('filter') . '%');
                })->orderBy('created_at', 'Desc')->paginate(15);
                $services->appends(['columna' => request()->get('columna'), 'filter' => request()->get('filter')]);
                break;

            case 'modelo':
                $services  = Service::with(
                    'cliente:id,nombre,apellido,identificacion,direccion',
                    'users:user_id,name',
                    'equipo:id,marca,modelo,serie',
                    'estado:id,nombre',
                    'equipo.marca:id,nombre',
                    'modo:id,nombre',
                    'tipo:id,nombre',
                    'razon:id,nombre'
                )->whereHas('equipo', function ($query) {
                    $query->where('modelo', 'like', '%' . request()->get('filter') . '%');
                })->orderBy('created_at', 'Desc')->paginate(15);
                $services->appends(['columna' => request()->get('columna'), 'filter' => request()->get('filter')]);
                break;

            case 'marca':
                $services  = Service::with(
                    'cliente:id,nombre,apellido,identificacion,direccion',
                    'users:user_id,name',
                    'equipo:id,marca,modelo,serie',
                    'estado:id,nombre',
                    'equipo.marca:id,nombre',
                    'modo:id,nombre',
                    'tipo:id,nombre',
                    'razon:id,nombre'
                )->whereHas('equipo.marka', function ($query) {
                    $query->where('nombre', 'like', '%' . request()->get('filter') . '%');
                })->orderBy('created_at', 'Desc')->paginate(15);
                $services->appends(['columna' => request()->get('columna'), 'filter' => request()->get('filter')]);
                break;

            case 'serie':
                $services  = Service::with(
                    'cliente:id,nombre,apellido,identificacion,direccion',
                    'users:user_id,name',
                    'equipo:id,marca,modelo,serie',
                    'estado:id,nombre',
                    'equipo.marca:id,nombre',
                    'modo:id,nombre',
                    'tipo:id,nombre',
                    'razon:id,nombre'
                )->whereHas('equipo', function ($query) {
                    $query->where('serie', 'like', '%' . request()->get('filter') . '%');
                })->orderBy('created_at', 'Desc')->paginate(15);
                $services->appends(['columna' => request()->get('columna'), 'filter' => request()->get('filter')]);
                break;

            case 'identificacion':
                $services  = Service::with(
                    'cliente:id,nombre,apellido,identificacion,direccion',
                    'users:user_id,name',
                    'equipo:id,marca,modelo,serie',
                    'estado:id,nombre',
                    'equipo.marca:id,nombre',
                    'modo:id,nombre',
                    'tipo:id,nombre',
                    'razon:id,nombre'
                )->whereHas('cliente', function ($query) {
                    $query->where('identificacion', 'like', '%' . request()->get('filter') . '%');
                })->orderBy('created_at', 'Desc')->paginate(15);
                $services->appends(['columna' => request()->get('columna'), 'filter' => request()->get('filter')]);
                break;

            case 'estado':
                $services  = Service::with(
                    'cliente:id,nombre,apellido,identificacion,direccion',
                    'users:user_id,name',
                    'equipo:id,marca,modelo,serie',
                    'estado:id,nombre',
                    'equipo.marca:id,nombre',
                    'modo:id,nombre',
                    'tipo:id,nombre',
                    'razon:id,nombre'
                )->whereHas('estado', function ($query) {
                    $query->where('nombre', 'like', '%' . request()->get('filter') . '%');
                })->orderBy('created_at', 'Desc')->paginate(15);
                $services->appends(['columna' => request()->get('columna'), 'filter' => request()->get('filter')]);
                break;

            case 'tipo':
                $services  = Service::with(
                    'cliente:id,nombre,apellido,identificacion,direccion',
                    'users:user_id,name',
                    'equipo:id,marca,modelo,serie',
                    'estado:id,nombre',
                    'equipo.marca:id,nombre',
                    'modo:id,nombre',
                    'tipo:id,nombre',
                    'razon:id,nombre'
                )->whereHas('tipo', function ($query) {
                    $query->where('nombre', 'like', '%' . request()->get('filter') . '%');
                })->orderBy('created_at', 'Desc')->paginate(15);
                $services->appends(['columna' => request()->get('columna'), 'filter' => request()->get('filter')]);
                break;

            case 'modo':
                $services  = Service::with(
                    'cliente:id,nombre,apellido,identificacion,direccion',
                    'users:user_id,name',
                    'equipo:id,marca,modelo,serie',
                    'estado:id,nombre',
                    'equipo.marca:id,nombre',
                    'modo:id,nombre',
                    'tipo:id,nombre',
                    'razon:id,nombre'
                )->whereHas('modo', function ($query) {
                    $query->where('nombre', 'like', '%' . request()->get('filter') . '%');
                })->orderBy('created_at', 'Desc')->paginate(15);
                $services->appends(['columna' => request()->get('columna'), 'filter' => request()->get('filter')]);
                break;

            case 'tecnico':
                $services  = Service::with(
                    'cliente:id,nombre,apellido,identificacion,direccion',
                    'users:user_id,name',
                    'equipo:id,marca,modelo,serie',
                    'estado:id,nombre',
                    'equipo.marca:id,nombre',
                    'modo:id,nombre',
                    'tipo:id,nombre',
                    'razon:id,nombre'
                )->whereHas('users', function ($query) {
                    $query->where('name', 'like', '%' . request()->get('filter') . '%');
                })->orderBy('created_at', 'Desc')->paginate(15);
                $services->appends(['columna' => request()->get('columna'), 'filter' => request()->get('filter')]);
                break;
        }



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
