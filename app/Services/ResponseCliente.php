<?php

namespace App\Services;

use App\Cliente;

class ResponseCliente
{

    public function index()
    {
        return datatables(Cliente::latest())
            ->addColumn('action', function ($cliente) {
                $button =  '<div class="text-lg-right text-nowrap">';
                $button .=
                    '<a class="btn btn-circle btn-primary mr-1" href="javascript:void(0)" onclick="editarCliente(' . $cliente->id . ')"
                title="Editar">
                <i class="fa fa-edit"></i>
                </a>';
                $button .=
                    '<a class="btn btn-circle btn-success mr-1" href="javascript:void(0)" data-toggle="modal" data-placement="top"
                data-target="#modalEquipoRegisterEquipoServicio" onclick="addEquipoService(' . $cliente->id . ')" title="Agregar Servicio" id="addEquipoService">
                <i class="fa fa-fw fa-plus"></i>
                </a>';
                $button .=
                    '<a class="btn btn-circle btn-dark mr-1" href="./clientes/servicios/' . $cliente->id . '"
                title="Servicios registrados">
                <i class="fa fa-fw fa-eye"></i>
                </a>';
                $button .=
                    '<a class="btn btn-circle btn-danger" href="javascript:void(0)" onclick="eliminarCliente(' . $cliente->id . ')"
                title="Eliminar">
                <i class="fa fa-fw fa-trash"></i>
                </a>';
                $button .= '</div>';
                return $button;
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->toJson();
    }
}
