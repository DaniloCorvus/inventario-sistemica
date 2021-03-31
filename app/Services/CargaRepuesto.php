<?php

namespace App\Services;

use App\Accesorio;
use App\Historia;
use App\Repuesto;
use App\Service;
use Illuminate\Support\Facades\Auth;

class CargaRepuesto
{

    public function cargar()
    {
        try {
            $repuesto = Repuesto::findOrFail(request()->get('id'));
            if ($repuesto->cant_disponible < request()->get('cantidad')) {
                //Error
                return response()->json('No hay tal disponibilidad', 400);
            }
            $service = Service::findOrFail(request()->get('service_id'));
            Historia::create([
                'descripcion' => 'Se han cargado Repuestos: Cantidad ' . request()->get('cantidad') . '  numero de parte  '
                    . $repuesto->num_parte  . '  de la orden de compra  ' . $repuesto->orden_compra . '  ID factura:  ' . $repuesto->num_factura,
                'user_id' => Auth::user()->id,
                'service_id' => request()->get('service_id'),
            ]);

            $service->repuestos()->attach(Repuesto::where('id', request()->get('id'))->first());

            Accesorio::create([
                'repuesto_id' => request()->get('id'),
                'cantidad' => request()->get('cantidad'),
                'user_id' => Auth::user()->id,
                'service_id' => request()->get('service_id'),
            ]);

            $repuesto->cant_disponible =  ($repuesto->cant_disponible - request()->get('cantidad'));
            $repuesto->save();
            return response()->json('Operacion de carga exitosa');
        } catch (\Throwable $th) {
            return  response()->json($th->getMessage());
        }
    }
}
