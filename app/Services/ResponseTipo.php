<?php

namespace App\Services;

use App\Tipo;

class ResponseTipo
{

    public function index()
    {

        return datatables(Tipo::latest())
            ->editColumn('action', function ($tipo) {
                $button =  '<div class="text-lg-right text-nowrap">';
                $button .=
                    '<a class="btn btn-circle btn-primary mr-1" href="javascript:void(0)" onclick="editarTipo(' . $tipo->id . ')"
                    title="Editar">
                    <i class="fa fa-edit"></i>
                    </a>';
                $button .=
                    '<a class="btn btn-circle btn-danger" href="javascript:void(0)" onclick="eliminarTipo(' . $tipo->id . ')"
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
