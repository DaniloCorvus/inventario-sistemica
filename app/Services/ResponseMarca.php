<?php

namespace App\Services;

use App\Marca;

class ResponseMarca
{

    public function index()
    {
        return datatables(Marca::latest())
            ->editColumn('action', function ($marca) {
                $button =  '<div class="text-lg-right text-nowrap">';
                $button .=
                    '<a class="btn btn-circle btn-primary mr-1" href="javascript:void(0)" onclick="editarMarca(' . $marca->id . ')"
                    title="Editar">
                    <i class="fa fa-edit"></i>
                    </a>';
                $button .=
                    '<a class="btn btn-circle btn-danger" href="javascript:void(0)" onclick="eliminarMarca(' . $marca->id . ')"
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
