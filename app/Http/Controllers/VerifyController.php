<?php

namespace App\Http\Controllers;

use App\Equipo;
use App\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VerifyController extends Controller
{
    public function verify()
    {

        if (request()->wantsJson()) {

            try {
                return response()->json(Service::with([
                    'equipo' =>  function ($e) {
                        $e->select('id', 'descripcion', 'serie', 'modelo');
                    },
                    'equipo.producto' =>  function ($e) {
                        $e->select('id', 'nombre');
                    },
                    'cliente' =>  function ($c) {
                        $c->select('id', 'nombre', 'apellido', 'telefono', 'opcional_telefono');
                    }
                ])->where('cliente_id', request()->get('cliente'))->select('id', 'cliente_id', 'equipo_id', 'fecha_inicio')->latest()->first());
            } catch (\Throwable $th) {
                return $th->getMessage();
            }
        }
    }

    public function verifyEquipo()
    {
        if (request()->wantsJson()) {
            try {


                $query =  Equipo::find(request()->get('equipo'))->services()->select('id', 'fecha_inicio')->get();

                $c = $query->reduce(function ($count, $service) {
                    if ($service->fecha_inicio >= Carbon::now()->subMonth(3)) {
                        return $count += 1;
                    }
                });

                $respon =  json_encode([
                    'type' => 'success',
                    'data' => [
                        'ingresos' => count($query),
                        'ultimo' =>  $query->last(),
                        'cantidad' => ($c) ? $c : 0
                    ]

                ]);

                return $respon;
            } catch (\Throwable $th) {
                return $th->getMessage();
            }
        }
    }
}
