<?php

namespace App\Http\Controllers;

use App\Razon;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EstadisticaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function query()
    {

        $users = DB::table('users')->get();
        $razones = DB::table('razons')->get();

        $user = (request()->has('id')) ? User::findOrFail(request()->get('id')) : Auth::user();


        $servicios = User::find($user->id)->services()->with([
            'adicionales' => function ($query) {
                $query->select(['id', 'service_id', 'valor'])->where('importeplus', 'on');
            },
            'gastos' => function ($query) {
                $query->select(['id', 'service_id', 'valor'])->where('importeminus', 'on');
            },
            'users' => function ($query) use ($user) {
                $query->select(['porcentual_home', 'porcentual_taller'])->where('user_id', $user->id);
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
        ])->withPivot('percent')
            ->get(['services.*', 'razon_id', 'modo_id', 'tipo_id', 'happycall_estado']);




        $happyCallNoEjecutados = $servicios->filter(function ($service) {
            if (preg_match("/1/i", $service->happycallestado)) {
                return $service;
            }
        });


        $pendientes = $servicios->filter(function ($service) {
            if (preg_match("/pendiente/i", $service->razon->nombre)) {
                return $service;
            }
        });

        $cancelados = $servicios->filter(function ($service) {
            if (preg_match("/cancel/i", $service->razon->nombre)) {
                return $service;
            }
        });


        $aceptadas = $servicios->filter(function ($service) {
            if (preg_match("/Reparacion Aceptada/i", $service->razon->nombre)) {
                return $service;
            }
        });

        $concertadas = $servicios->filter(function ($service) {
            if (preg_match("/Primera visita concertada/i", $service->razon->nombre)) {
                return $service;
            }
        });

        $solicitados = $servicios->filter(function ($service) {
            if (preg_match("/Los repuestos han sido solicitados/i", $service->razon->nombre)) {
                return $service;
            }
        });

        $terminadosMesActual = $servicios->filter(function ($service) {
            if (
                preg_match("/reparacion terminada/i", $service->razon->nombre) || preg_match(
                    "/reparacion cancelada/i",
                    $service->razon->nombre
                )
                || preg_match("/venta terminada/i", $service->razon->nombre)
            ) {
                if (\Carbon\Carbon::create($service->fecha_finalizado)->month == \Carbon\Carbon::now()->month) {
                    return $service;
                }
            }
        });

        $terminadosMesAnterior = $servicios->filter(function ($service) {
            if (
                preg_match("/reparacion terminada/i", $service->razon->nombre) || preg_match(
                    "/reparacion cancelada/i",
                    $service->razon->nombre
                )
                || preg_match("/venta terminada/i", $service->razon->nombre)
            ) {
                if (\Carbon\Carbon::create($service->fecha_finalizado)->month == (\Carbon\Carbon::now()->month - 1)) {
                    return $service;
                }
            }
        });

        $terminadosHoy = $servicios->filter(function ($service) {
            if (
                preg_match("/reparacion terminada/i", $service->razon->nombre) || preg_match(
                    "/reparacion cancelada/i",
                    $service->razon->nombre
                )
                || preg_match("/venta terminada/i", $service->razon->nombre)
            ) {
                if (\Carbon\Carbon::create($service->fecha_finalizado) == (\Carbon\Carbon::now())) {
                    return $service;
                }
            }
        });

        $terminadosAyer = $servicios->filter(function ($service) {
            if (
                preg_match("/reparacion terminada/i", $service->razon->nombre) || preg_match(
                    "/reparacion cancelada/i",
                    $service->razon->nombre
                )
                || preg_match("/venta terminada/i", $service->razon->nombre)
            ) {
                if (\Carbon\Carbon::create($service->fecha_finalizado) == (\Carbon\Carbon::now()->subDay())) {
                    return $service;
                }
            }
        });


        $montoMesAnterior = 0;
        foreach ($terminadosMesAnterior as $service) {
            $montoMesAnterior += $service->getApagar();
        }

        $montoMesActual = 0;
        foreach ($terminadosMesActual as $service) {
            $montoMesActual += $service->getApagar();
        }

        $primero = ($servicios->whereNotNull('fecha_finalizado'))->first();
        $ultimo = ($servicios->whereNotNull('fecha_finalizado'))->last();


        $montoTotal = 0;

        $servicios->each(function ($service) use ($montoTotal) {
            $montoTotal += $service->getApagar();
        });


        foreach ($servicios as $service) {
            $montoTotal += $service->getApagar();
        }

        if ($primero != null && $ultimo != null) {
            $meses = (\Carbon\Carbon::create($ultimo->fecha_finalizado))
                ->floatDiffInMonths(\Carbon\Carbon::create($primero->fecha_finalizado));

            if ($meses == 0) {
                $avg = ($montoTotal / 1);
            } else {
                $avg = ($montoTotal / $meses);
            }
        } else {
            $avg = 0;
            $meses = 0;
        }

        return view(
            'estadistica.tecnico',
            compact(
                'users',
                'servicios',
                'razones',
                'pendientes',
                'cancelados',
                'aceptadas',
                'happyCallNoEjecutados',
                'concertadas',
                'solicitados',
                'terminadosMesActual',
                'terminadosMesAnterior',
                'terminadosHoy',
                'terminadosAyer',
                'montoMesAnterior',
                'montoMesActual',
                'primero',
                'ultimo',
                'meses',
                'montoTotal',
                'avg'
            )
        );
    }
}
