<?php

namespace App\Http\Controllers;

use App\Charts\ServiceChart;
use App\Equipo;
use App\Marca;
use App\Modo;
use App\Service;
use App\Tipo;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceChartController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['can:get,App\User']);


    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public $tecnicos = array();
    public $auxtecnicos = array();
    public $auxservicios = array();
    public $servicios = array();
    public $color = array();
    public $results;

    public function index(Request $request)
    {


        switch (request('search')) {
            case 'Tipo':
                $aux = Service::whereBetween('fecha_finalizado', [Carbon::createFromDate(request()->get('min')), Carbon::createFromDate(request()->get('max'))->addDays(1)])
                    ->where('user_id', request()->get('id'))
                    ->select(DB::raw('count(*) as finalizados, tipo_id'))
                    ->orderBy('tipo_id')
                    ->groupBy('tipo_id')
                    ->each(function ($service) {
                        array_push($this->servicios, $service->finalizados);
                        array_push($this->tecnicos, $this->searchTipo($service->tipo_id)->nombre);
                    });
                break;
            case 'Modo':
                $aux = Service::whereBetween('fecha_finalizado', [Carbon::createFromDate(request()->get('min')), Carbon::createFromDate(request()->get('max'))->addDays(1)])
                    ->where('user_id', request()->get('id'))
                    ->select(DB::raw('count(*) as finalizados, modo_id'))
                    ->orderBy('modo_id')
                    ->groupBy('modo_id')
                    ->each(function ($service) {
                        array_push($this->servicios, $service->finalizados);
                        array_push($this->tecnicos, $this->searchModo($service->modo_id)->nombre);
                    });
                break;
            case 'Marca':
                $aux = Service::whereBetween('fecha_finalizado', [Carbon::createFromDate(request()->get('min')), Carbon::createFromDate(request()->get('max'))->addDays(1)])
                    ->where('user_id', request()->get('id'))
                    ->select(DB::raw('count(*) as finalizados, equipo_id'))
                    ->orderBy('equipo_id')
                    ->groupBy('equipo_id')
                    ->each(function ($service) {
                        array_push($this->auxservicios, $service->finalizados);
                        array_push($this->auxtecnicos, ['marca' => $this->searchEquipo($service->equipo_id)]);
                    });


                $grouped = collect($this->auxtecnicos)->mapToGroups(function ($item, $key) {
                    return [$item['marca'] => $item['marca']];
                });

                $grouped->each(function ($marca, $i) {
                    array_push($this->tecnicos, $i);
                    array_push($this->servicios, collect($marca)->count());
                });

                break;
            case 'Diario':
                break;

            default:

                $aux = Service::whereNotNull('fecha_finalizado')
                    ->whereBetween('fecha_finalizado', [Carbon::createFromDate(request()->get('min')), Carbon::createFromDate(request()->get('max'))->addDays(1)])
                    ->select(DB::raw('count(*) as finalizados, user_id'))
                    ->orderBy('user_id')
                    ->groupBy('user_id')
                    ->each(function ($service) {
                        array_push($this->servicios, $service->finalizados);
                        array_push($this->tecnicos, $this->searchTecnico($service->user_id)->name);
                    });
                break;
        }

        for ($k = 0; $k < sizeof($this->servicios); $k++) {
            array_push($this->color, $this->colorAleatorio());
        }

        $serviceChart = new ServiceChart;
        $serviceChart->labels($this->tecnicos);
        $serviceChart->dataset('Finalizados', 'bar', $this->servicios)
            ->options([
                'fill' => 'false',
                'backgroundColor' => $this->color,

            ]);

        $users = User::orderBy('name')->get(['name', 'id']);
        return (isset($serviceChart)) ?  view('charts.serviceChart', compact('serviceChart', 'users')) :  view('charts.serviceChart', 'users');
    }

    public function colorAleatorio()
    {

        $hexadecimal = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "A", "B", "C", "D", "E", "F");
        $color_aleatorio = "#";

        for ($i = 0; $i < 6; $i++) {
            $posarray = rand(0, sizeof($hexadecimal) - 1);
            $color_aleatorio .= $hexadecimal[$posarray];
        }
        return $color_aleatorio;
    }


    public function searchTecnico(int $id)
    {
        $user = User::findOrFail($id);
        return $user;
    }
    public function searchModo(int $id)
    {
        $modo = Modo::findOrFail($id);
        return $modo;
    }
    public function searchTipo(int $id)
    {
        $tipo = Tipo::findOrFail($id);
        return $tipo;
    }

    public function searchEquipo(int $id)
    {
        $equipo = Equipo::with('marca')->findOrFail($id);
        return ($equipo->marka->nombre) ? $equipo->marka->nombre : 'sin marca';
    }
}
