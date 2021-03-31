<?php

namespace App\Services;

use App\Service;
use Carbon\Carbon;

class FiltrarService
{
    public function filtro($finicio, $ffin)
    {
        try {

            $inicio = Carbon::createFromDate($finicio);
            $fin = Carbon::createFromDate($ffin)->addDays(1);

            if (request()->expectsJson()) {
                return datatables(Service::with('cliente', 'user', 'equipo', 'equipo.marca', 'estado', 'modo', 'tipo', 'razon')->whereBetween('fecha_inicio', [$inicio, $fin])->get())
                    ->editColumn('action', function ($service) {
                        $button =  '<div class="text-lg-right text-nowrap">';
                        $button .=
                            '<a class="btn btn-circle btn-danger" href="javascript:void(0)" onclick="eliminarService(' . $service->id . ')"
                        title="Eliminar">
                        <i class="fa fa-fw fa-trash"></i>
                        </a>';
                        $button .= '</div>';
                        return $button;
                    })->setRowClass(function ($service) {

                        switch ($service->razon->id) {
                            case 1:
                                return "red";
                                break;
                            case 2:
                                return 'pink';
                                break;
                            case 3:
                                return 'purple ';
                                break;
                            case 4:
                                return 'dee';
                                break;
                            case 5:
                                return 'indigo';
                                break;
                            case 6:
                                return "blue";
                                break;
                            case 7:
                                return 'light-blue';
                                break;
                            case 8:
                                return 'cyan';
                                break;
                            case 9:
                                return 'teal';
                                break;
                            case 10:
                                return 'green';
                                break;
                            case 11:
                                return "light-green";
                                break;
                            case 12:
                                return 'lime';
                                break;
                            case 13:
                                return 'yellow';
                                break;
                            case 14:
                                return 'alert-success';
                                break;
                            case 15:
                                return 'blue-gray';
                                break;
                            case 16:
                                return "deep";
                                break;
                            case 17:
                                return 'brown';
                                break;
                            case 18:
                                return 'gray';
                                break;
                            case 19:
                                // return 'blue-gray';
                                break;
                            case 20:
                                return 'purple';
                                break;
                            default:
                                return 'deep-purple';
                        }
                    })
                    ->rawColumns(['action'])
                    ->addIndexColumn()
                    ->toJson();
            }
        } catch (\Throwable $th) {
            return json_encode($th->getMessage());
        }
    }
}
