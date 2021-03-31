<?php

namespace App\Services;

use App\Equipo;
use App\Service;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class ResponseEquipo
{

    public function index()
    {
        $equiposCache =  Cache::rememberForever('equiposCache', function () {
            return Equipo::with('cliente', 'producto', 'services')
                ->get(['id', 'cliente_id', 'descripcion', 'modelo', 'serie']);
        });

        return datatables($equiposCache)
            ->editColumn('action', function ($equipo) {

                $button =  '<div class="text-lg-right text-nowrap">';
                $button .=
                    '<a class="btn btn-circle btn-primary mr-1" href="javascript:void(0)" onclick="editarEquipo(' . $equipo->id . ')"
                            title="Editar">
                            <i class="fa fa-edit"></i>
                            </a>';
                $button .=
                    '<a class="btn btn-circle btn-dark mr-1" href="./equipos/servicios/' . $equipo->id . '"
                            title="Servicios registrados">
                            <i class="fa fa-fw fa-eye"></i>
                            </a>';
                $button .=
                    '<a class="btn btn-circle btn-success mr-1" href="javascript:void(0)" data-toggle="modal" data-placement="top"
                            data-target="#modalRegisterEquipoAndServicio" onclick="addService(' .   $equipo->id .  ',' . $equipo->cliente->id . ')" title="Agregar Servicio" id="addService">
                            <i class="fa fa-fw fa-plus"></i>
                            </a>';
                $button .=
                    '<a class="btn btn-circle btn-danger mr-1" href="javascript:void(0)" onclick="eliminarEquipo(' . $equipo->id . ')"
                            title="Eliminar">
                            <i class="fa fa-fw fa-trash"></i>
                            </a>';
                $button .= '</div>';

                return $button;
            })
            ->rawColumns(['action'])
            // ->addColumn('relaciones', function ($equipo) {
            //     return Service::where('equipo_id', $equipo->id)->get();
            // })
            ->addIndexColumn()
            ->toJson();
    }
}
