<?php

namespace App\Services;

use App\Clausula;

class ResponseClausula
{

    public function index()
    {
        return datatables(Clausula::with('marca')->latest())
            ->editColumn('action', function ($clausula) {
                $button =  '<div class="text-lg-right text-nowrap">';
                $button .=
                    '<a class="btn btn-circle btn-primary mr-1" href="javascript:void(0)" onclick="editarClausula(' . $clausula->id . ')"
                    title="Editar">
                    <i class="fa fa-edit"></i>
                    </a>';
                $button .=
                    '<a class="btn btn-circle btn-danger" href="javascript:void(0)" onclick="eliminarClausula(' . $clausula->id . ')"
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
