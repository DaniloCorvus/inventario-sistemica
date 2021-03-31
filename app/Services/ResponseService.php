<?php

namespace App\Services;

use App\Cliente;
use App\Equipo;
use App\Estado;
use App\HappycallEstado;
use App\Marca;
use App\Modo;
use App\Producto;
use App\Razon;
use App\Reparacion;
use App\Service;
use App\Tipo;
use App\User;
use Illuminate\Support\Facades\Auth;

class ResponseService
{

    public function index()
    {
        return Service::with([
            'cliente' =>  function ($c) {
                $c->select('id', 'nombre', 'apellido', 'identificacion', 'direccion');
            },
            'users' =>  function ($u) {
                $u->select('user_id', 'name');
            },
            'equipo' =>  function ($e) {
                $e->select('id', 'marca', 'modelo', 'serie');
            },
            'equipo.marka' =>  function ($e) {
                $e->select('id', 'nombre');
            },
            'estado' =>  function ($es) {
                $es->select('id', 'nombre');
            },
            'modo' =>  function ($m) {
                $m->select('id', 'nombre');
            },

            'tipo' =>  function ($t) {
                $t->select('id', 'nombre');
            },

            'razon' =>  function ($r) {
                $r->select('id', 'nombre');
            },
            'users' =>  function ($r) {
                $r->select('name');
            },
        ])->orderBy('created_at', 'Desc')->paginate(15, [
            'id', 'radicado',
            'razon_id', 'fecha_inicio', 'equipo_id', 'cliente_id', 'estado_id',
            'tipo_id', 'modo_id', 'fecha_finalizado', 'created_at'
        ]);
    }


    public function show($service)
    {

        $clientes = Cliente::OrderBy('nombre', 'Asc')->toBase()->get();
        $users = User::OrderBy('name', 'Asc')->toBase()->get();
        $equipos = Equipo::OrderBy('serie', 'Asc')->toBase()->get();
        $estados = Estado::OrderBy('nombre', 'Asc')->toBase()->get();
        $modos = Modo::OrderBy('nombre', 'Asc')->toBase()->get();
        $tipos = Tipo::OrderBy('nombre', 'Asc')->toBase()->get();
        $razons = Razon::OrderBy('nombre', 'Asc')->toBase()->get();
        $marcas = Marca::OrderBy('nombre', 'Asc')->toBase()->get();
        $descripciones = Producto::OrderBy('nombre', 'Asc')->toBase()->get();
        $typereparacions = Reparacion::OrderBy('nombre', 'Asc')->toBase()->get();
        $happycallestados = HappycallEstado::OrderBy('nombre', 'Asc')->toBase()->get();

        return view('admin.services.show', compact('service', 'happycallestados', 'typereparacions', 'marcas', 'descripciones', 'clientes', 'users', 'equipos', 'estados', 'modos', 'tipos', 'razons'));
    }
    
    public function indexTecnico()
    {
        return User::find(Auth::user()->id)->services()->with([
            'cliente' =>  function ($c) {
                $c->select('id', 'nombre', 'apellido', 'identificacion', 'direccion');
            },
            'users' =>  function ($u) {
                $u->select('user_id', 'name');
            },
            'equipo' =>  function ($e) {
                $e->select('id', 'marca', 'modelo', 'serie');
            },
            'equipo.marka' =>  function ($e) {
                $e->select('id', 'nombre');
            },
            'estado' =>  function ($es) {
                $es->select('id', 'nombre');
            },
            'modo' =>  function ($m) {
                $m->select('id', 'nombre');
            },

            'tipo' =>  function ($t) {
                $t->select('id', 'nombre');
            },

            'razon' =>  function ($r) {
                $r->select('id', 'nombre');
            },
            'users' =>  function ($r) {
                $r->select('name');
            },
        ])->orderBy('created_at', 'Desc')->paginate(15);
    }
}
