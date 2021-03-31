<?php

namespace App\Http\Controllers;

use App\Exports\CorteExport;
use App\Exports\ProduccionExport;
use App\Exports\RecepcionDineroExport;
use App\Exports\SalidaExport;
use App\Exports\ServiciosExport;
use App\Service;
use App\User;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade as PDF;
use Maatwebsite\Excel\Facades\Excel;

class InformesController extends Controller
{

    public function __construct()
    {
        //TODO: Authorization
        $this->middleware(['auth']);
        $this->middleware(['can:get,App\User']);
    }
    public function informe()
    {
        try {
            $inicio = Carbon::createFromDate(request()->get('min'))->format('Y-m-d');
            $fin = Carbon::createFromDate(request()->get('max'))->format('Y-m-d');
            $requestTecnico = User::findOrFail(request()->get('tecnico'));


            $servicios = User::find(request()->get('tecnico'))->services()->with([
                'adicionales' => function ($query) {
                    $query->select(['id', 'service_id', 'valor'])->where('importeplus', 'on');
                },
                'gastos' => function ($query) {
                    $query->select(['id', 'service_id', 'valor'])->where('importeminus', 'on');
                },
                'users' => function ($query) {
                    $query->select(['porcentual_home', 'porcentual_taller'])->where('user_id', request()->get('tecnico'));
                },
                'razon' => function ($query) {
                    $query->select(['id', 'nombre']);
                },
                'happycallestado' => function ($query) {
                    $query->select(['id']);
                },
                'modo' => function ($query) {
                    $query->select(['id', 'nombre']);
                },
                'tipo' => function ($query) {
                    $query->select(['id', 'nombre']);
                },

                'cliente',
                'equipo',
                'equipo.marca',
                'estado',
                'repuestos',

            ])->whereNotNull('fecha_finalizado')
                ->whereBetween('fecha_finalizado', [$inicio, $fin])
                ->whereHas('razon', function ($query) {
                    $query->where('nombre', 'Reparacion Terminada');
                })->get();


            if ($servicios->count() > 0) {

                switch (request()->get('option')) {
                    case 'pdf':
                        $pdf = PDF::loadView('informes.produccion.excel', compact('servicios', 'inicio', 'fin', 'requestTecnico'), [])->setPaper('legal', 'landscape');
                        return $pdf->download('informeProduccion.pdf');
                        break;

                    default:
                        return Excel::download(new ProduccionExport($servicios, $inicio, $fin, $requestTecnico), "informeProduccion" . Carbon::now() . ".xlsx");
                        break;
                }
            }
            abort(404);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function Corte()
    {
        try {
            return Excel::download(new CorteExport(request()->all()), "informeCorte" . Carbon::now() . ".xlsx");
        } catch (\Throwable $th) {
            return json_encode($th->getMessage());
        }
    }

    public function entrefechas()
    {

        try {
            return Excel::download(new ServiciosExport(request()->all()), "informeEntreFechas " . Carbon::now() . ".xlsx");
        } catch (\Throwable $th) {
            return json_encode($th->getMessage());
        }
    }

    public function dineros()
    {
        try {
            return Excel::download(new RecepcionDineroExport(request()->all()), "informeDineroRecibido" . Carbon::now() . ".xlsx");
        } catch (\Throwable $th) {
            return json_encode($th->getMessage());
        }
    }

    public function salida()
    {
        try {
            return Excel::download(new SalidaExport(request()->all()), "informeSalida " . Carbon::now() . ".xlsx");
        } catch (\Throwable $th) {
            return json_encode($th->getMessage());
        }
    }
}
