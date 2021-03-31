<?php

namespace App\Services;

use App\HappycallEstado;

class ResponseHappyCallEstado
{

    public function index()
    {
        return datatables(HappycallEstado::latest())
            ->editColumn('action', function ($happycallEstadodo) {
                $button =  '<div class="text-lg-right text-nowrap">';
                $button .=
                    '<a class="btn btn-circle btn-primary mr-1" href="javascript:void(0)" onclick="editarHappyCallEstado(' . $happycallEstadodo->id . ')"
                        title="Editar">
                        <i class="fa fa-edit"></i>
                        </a>';
                $button .=
                    '<a class="btn btn-circle btn-danger" href="javascript:void(0)" onclick="eliminarHappyCallEstado(' . $happycallEstadodo->id . ')"
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
