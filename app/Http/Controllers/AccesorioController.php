<?php

namespace App\Http\Controllers;

use App\Accesorio;
use App\Service;

class AccesorioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('service');
    }

    public function service($service)

    {

        $query = Service::With('repuestos.accesorios')->findOrFail($service);
        $repuesto = collect($query->repuestos)->where('pivot.service_id', $query->id);

        $response = $repuesto->map(function ($element, $i) {
            return [
                'cantidad' => $element->accesorios,
                'fecha_solicitud' => $element->fecha_solicitud,
                'fecha_recibido' => $element->fecha_recibido,
                'num_pedido' =>  $element->num_pedido,
                'num_parte' =>  $element->num_parte,
                'delivery_orden' => $element->delivery_orden,
                'cod_interno' => $element->cod_interno,
                'num_factura' => $element->num_factura,
                'valor_before_iva' => $element->valor_before_iva,
                'id' => $element->id
            ];
        });



        // if (request()->expectsJson()) {
        try {
            return datatables(collect($response))
                ->editColumn('action', function ($repuesto) use ($service) {
                    $button =  '<div class="text-lg-right text-nowrap">';
                    $button .=
                        '<a class="btn btn-circle btn-dark text-white" javascript:void(0) onclick="eliminarAccesorio(' . $repuesto['id'] . ',' . $service . ')"
                    title="Eliminar">
                    <i class="fa fa-fw fa-trash"></i>
                    </a>';
                    $button .= '</div>';
                    return $button;
                })->addIndexColumn()
                ->toJson();
        } catch (\Throwable $th) {
            return response($th->getMessage());
        }
        // }

        return  abort(404);
    }
}
