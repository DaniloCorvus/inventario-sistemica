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
use App\Repuesto;
use App\Service;
use App\Tipo;
use App\User;

class QueryService
{
    public function query()
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
        $happycallestados = HappycallEstado::toBase()->get();

        $this->getInfo(request()->get('query'));

        $service = $this->getInfo(request()->get('query'));

        if ($service) {
            return view('admin.services.show', compact('service', 'typereparacions', 'happycallestados', 'marcas', 'descripciones', 'clientes', 'users', 'equipos', 'estados', 'modos', 'tipos', 'razons'));
        }

        $query = request()->get('query');
        return view('admin.nofound', compact('query'));
    }


    public function getInfo($id)
    {

        return Service::with(
            [
                'repuestos', 'comentarios', 'adicionales'  => function ($query) {
                    $query->where('importeplus', 'on');
                },
                'gastos' => function ($query) {
                    $query->where('importeminus', 'on');
                },
                'repuestos',
                'users:user_id,name',
                'cliente',
                'equipo',
                'modo:id,nombre'
            ]

        )->findOrFail($id);
    }
}
