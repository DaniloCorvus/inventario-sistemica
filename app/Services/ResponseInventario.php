<?php

namespace App\Services;

use App\Models\Cellar;
use Illuminate\Support\Facades\DB;
use App\Models\Inventario;
use Milon\Barcode\DNS1D;
use Psy\Command\EditCommand;

class ResponseInventario
{

    public function index()
    {
        $query = '
        SELECT  p.num_parte,
                p.codigo,
                p.cod_interno,
                p.modelo,
                cl.nombre as cellar,
                i.serie,
                i.cantidad_disponible,
                i.id,

                IFNULL((
                    SELECT costo_venta
                    FROM  cargues_inventario c
                    where c.inventario_id = i.id
                    ORDER BY c.created_at DESC LIMIT 1
                ),0) AS costo_venta

                FROM inventario i
                INNER JOIN productox p on p.id = i.productox_id
                INNER JOIN cellars cl on cl.id = i.cellar_id

        ';
        $res = DB::select($query);


        return datatables($res)
            ->editColumn('action', function ($Inventario) {
                $button =  '<div class="text-lg-right text-nowrap">';
                $button .=
                    '<a class="btn btn-circle btn-primary mr-1" href="/cargue-inventario/' . $Inventario->id . '"
                    title="VerHistorial">
                    <i class="fa fa-eye"></i>
                    </a>';
                    $button .=
                    '

                        <a  onclick="abrirTranslado('.$Inventario->id.')" href="javascript:void(0)" class="tooltip-wrapper btn btn-circle btn-primary mr-1" data-toggle="modal"
                        data-placement="top" data-target="#modalHistoriaRegister" title="Traslado de bodega">
                        <i class="fa fa-fw fa-plus"></i>
                     </a>

                    ';
                $button .= '</div>'
                ;
                return $button;
            })->editColumn('codigo',  function ($Inventario) {
                $barra = new DNS1D();
                return   $barra->getBarcodePNG($Inventario->codigo, 'C39', 3, 33, array(1, 1, 1), true);
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->toJson();
    }
}
