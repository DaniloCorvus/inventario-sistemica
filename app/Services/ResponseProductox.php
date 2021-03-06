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
                $button .=
                    '<a class="btn btn-circle btn-success" style="margin-left:5px;" href="/productox/'. $producto->id .'/ventas"
                    title="Ventas">
                    <i class="fa fa-fw fa-store"></i>
                    </a>';
                $button .= '</div>';
                return $button;
            })

            ->editColumn('estado', function ($producto) {
                $button =  '<div class="text-lg-right text-nowrap">';
                    $button .=
                        '

                        <select onChange="cambiarEstado('.$producto->id.',event.target.value)" name="estado"
                            class="form-contol custom-select" style="width:100%" required>
                            <option value="activo" '.($producto->estado=='activo' ? 'selected' : '').' >Activo</option>
                            <option value="inactivo"  '.($producto->estado=='inactivo' ? 'selected' : '').' >Inactivo</option>

                        </select>
                ';
                    $button .= '</div>';
                    return $button;
            })
            ->rawColumns(['action','estado'])
            ->addIndexColumn()
            ->toJson();
    }
}
