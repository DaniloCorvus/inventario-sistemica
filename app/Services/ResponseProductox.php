<?php

namespace App\Services;

use App\Models\Producto;

class ResponseProductox
{

    public function index()
    {
        return datatables(Producto::latest())
            ->editColumn('action', function ($producto) {
                $button =  '<div class="text-lg-right text-nowrap">';
                $button .=
                    '<a class="btn btn-circle btn-primary mr-1" href="javascript:void(0)" onclick="editarProducto(' . $producto->id . ')"
                    title="Editar">
                    <i class="fa fa-edit"></i>
                    </a>';
                $button .=
                    '<a class="btn btn-circle btn-danger" href="javascript:void(0)" onclick="eliminarProducto(' . $producto->id . ')"
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
