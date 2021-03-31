<?php

namespace App\Observers;

use App\Historia;
use App\Razon;
use App\Repuesto;
use App\Service;
use Illuminate\Support\Facades\Auth;

class RepuestoObserver
{

    public function creating(Repuesto $repuesto)
    {
        try {
            $repuesto->cant_disponible = 0;
            $service = Service::findOrFail(request()->get('service_id'));
            $razon = Razon::where('nombre', 'like', '%' . request()->get('estado') . '%')->first();
            if (!empty($razon)) {
                $service->razon_id =  $razon->id;
                $service->save();
                Historia::create([
                    'descripcion' => $razon->nombre . '   ' . 'Descripcion : '.
                    'Se han solicitado Repuestos: Cantidad ' . request()->get('cantidad') . ' TCA  '
                        . $repuesto->num_parte  . 
                        ' PON :' .$repuesto->num_pedido .
                        ' ID interno : ' . $repuesto->cod_interno .
                        ' ID factura:  ' . $repuesto->num_factura,
                        'user_id' => Auth::user()->id,
                        'service_id' => $service->id,

                    'user_id' => Auth::user()->id,
                    'service_id' => $service->id,
                ]);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }


    public function updating(Repuesto $repuesto)
    {
        try {
            if ($repuesto->isDirty('estado')) {
                $service = Service::findOrFail(request()->get('service_id'));
                $razon = Razon::where('nombre', 'like', '%' . request()->get('estado') . '%')->first();
                if (request()->get('estado') == 'recibido') {
                    $repuesto->cant_disponible = request()->get('cantidad');
                } else {
                    $repuesto->cant_disponible = 0;
                }
                if (!empty($razon)) {
                    $service->razon_id =  $razon->id;
                    $service->save();
                    Historia::create([
                        'descripcion' => $razon->nombre,
                        'user_id' => Auth::user()->id,
                        'service_id' => $service->id
                    ]);
                }
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Handle the  repuesto "deleted" event.
     *
     * @param  \App\Repuesto  $repuesto
     * @return void
     */
    public function deleted(Repuesto $repuesto)
    {
        //
    }

    /**
     * Handle the  repuesto "restored" event.
     *
     * @param  \App\Repuesto  $repuesto
     * @return void
     */
    public function restored(Repuesto $repuesto)
    {
        //
    }

    /**
     * Handle the  repuesto "force deleted" event.
     *
     * @param  \App\Repuesto  $repuesto
     * @return void
     */
    public function forceDeleted(Repuesto $repuesto)
    {
        //
    }
}
