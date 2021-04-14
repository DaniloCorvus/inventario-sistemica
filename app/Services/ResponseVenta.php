<?php

namespace App\Services;

use App\Models\Venta;
use Illuminate\Support\Facades\DB;

class ResponseVenta
{

    public function index()
    {
        $venta = DB::select('select v.*,
                 concat("REM",v.id) as remision,
                 concat_ws(" ",c.nombre,c.apellido) as cliente,
                 u.name as vendedor
              FROM ventas v
              INNER JOIN clientes c ON c.id = v.cliente_id
              LEFT JOIN users u ON u.id = v.user_id

              ORDER BY id DESC');
        return datatables($venta)
            ->editColumn('action', function ($categoria) {

                $button =  '<div class="text-lg-right text-nowrap">';
                // $button .=
                //     '<a class="btn btn-circle btn-primary mr-1" href="javascript:void(0)" onclick="editarVenta(' . $categoria->id . ')"
                //             title="Editar">
                //             <i class="fa fa-edit"></i>
                //             </a>';
                $button .=
                    '
                    <a class="btn btn-circle btn-primary mr-1" href="/detalle-venta/' . $categoria->id . '"
                        title="Ver">
                        <i class="fa fa-eye"></i>
                        </a>
                    <a class="btn btn-circle btn-primary mr-1" href="/descargar-venta/' . $categoria->id . '"
                    title="Ver">
                    <i class="fa fa-download"></i>
                    </a>

                    <a class="btn btn-circle btn-danger mr-1" href="javascript:void(0)" onclick="eliminarVenta(' . $categoria->id . ')"
                            title="Eliminar">
                            <i class="fa fa-fw fa-trash"></i>
                            </a>
                     </div>';

                return $button;
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->toJson();
    }
}
