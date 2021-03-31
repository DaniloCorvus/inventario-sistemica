<?php

namespace App\Http\Controllers;

use App\HappycallEstado;
use App\Modo;
use App\Service;
use App\Tipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UpdateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        switch (request()->get('filter')) {
            case 'null':
                $filter   =  null;
                break;

            default:
                if (request()->get('filter')) {
                    $aux = HappycallEstado::where('nombre', request()->get('filter'))->first();
                    $filter = $aux->id;
                } else {
                    $filter   =  null;
                }
                break;
        }

        $services  = Service::with(
            'estado:id,nombre',
            'modo:id,nombre',
            'tipo:id,nombre',
            'happycallestado:id,nombre',
        )
            ->where('happycall_estado', $filter)
            ->orderBy('created_at', 'Desc')->paginate(15);
        $services->appends(['filter' => request()->get('filter')]);

        $modos = Modo::get(['id', 'nombre']);
        $tipos = Tipo::get(['id', 'nombre']);
        $happys = HappycallEstado::get(['id', 'nombre']);

        return view('admin.update.front', compact('services', 'modos', 'tipos', 'happys'));
    }
}
