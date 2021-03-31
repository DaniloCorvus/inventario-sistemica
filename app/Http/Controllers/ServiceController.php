<?php

namespace App\Http\Controllers;



use App\Http\Requests\addTecnicoToService;
use App\Service;
use App\Http\Requests\ServiceSaveRequest;
use App\Http\Requests\ServiceUpdateRequest;
use App\Http\Resources\queryResource;
use App\Http\Resources\ServiceResource As ServiceResource;
use App\Services\AddTecnico;
use App\Services\FiltrarService;
use App\Services\PrintService;
use App\Services\QueryService;
use App\Services\ResponseService;
use App\Services\UpdateService;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;


class ServiceController extends Controller
{

    public function __construct(ResponseService $responseService)
    {
        $this->middleware('auth')->except('evidencias');
        $this->middleware(['can:get,App\User'])->except(['show']);

        $this->responseService = $responseService;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if (request()->expectsJson()) {
        //     return $this->responseService->index();
        // }
        return new ServiceResource(Service::class);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceSaveRequest $request)
    {

        if (request()->expectsJson()) {
            try {
                Service::create(request()->except(['sendMessage', 'telefono']));
                Cache::forget('servicesCache');
                return response()->json('Service registrado correctamente', 200);
            } catch (\Throwable $th) {
                return response()->json($th->getMessage());
            }
        }
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Transportes\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        if (request()->expectsJson()) {
            return response($service, 200);
        }
        return abort(404);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Transportes\Service  $service
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        if(Auth::user()->hasRole('admin') || Service::find($id)->users()->find(Auth::user()->id)){
            $service = $this->getInfoService(new QueryService, $id);
            return $this->responseService->show($service);
        }
        
        abort(401);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateService $updateService, ServiceUpdateRequest $request)
    {
        if (request()->expectsJson()) {
            $this->updateService = $updateService;
            return $this->updateService->update();
        }
        return abort(404);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \Transportes\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (request()->expectsJson()) {
            try {
                $service = Service::findOrFail($id);
                if (empty($service->fecha_finalizado)) {
                    $service->delete();
                    Cache::forget('servicesCache');
                    return response()->json('Service eliminado correctamente.', 200);
                }
                return response()->json('Service no se  puede eliminar.', 200);
            } catch (\Throwable $th) {
                return response()->json($th->getMessage(), 500);
            }
        }
        return abort(404);
    }


    public function filtro(FiltrarService $filtrarService, $finicio, $ffin)
    {
        $this->filtrarService = $filtrarService;
        return $this->filtrarService->filtrar($finicio, $ffin);
    }


    public function printservice(PrintService $printService)
    {
        $this->printService = $printService;
        return $this->printService->printservice();
    }


    public function evidencias(Service $service)
    {
        $evidencias = $service->evidencias()->get();
        return response($evidencias);
    }


    public function addTecnicoToService(AddTecnico $addTecnico, AddTecnicoToService $addTecnicoToService)
    {

        $this->addTecnico = $addTecnico;
        return $this->addTecnico->addTecnicoToService();
    }

    public function getInfoService(QueryService $queryService, $id)
    {
        $this->queryService = $queryService;
        return $this->queryService->getInfo($id);
    }

    /**
     * Obtener service
     */
    public function query(QueryService $queryService)
    {
        $this->queryService = $queryService;
        return $this->queryService->query();
    }

    /**
     * Obtener Gastos  y adicionales 
     */
    public function totalesgastosyadicionales($id)
    {
        if (request()->expectsJson()) {
            $adicionales = Service::findOrFail($id)->adicionales->sum('valor');
            $gastos = Service::findOrFail($id)->gastos->sum('valor');
            return  response()->json(['adicionales' => $adicionales, 'gastos' => $gastos], 200);
        }
    }

    /**
     * Obtener total de dinero ingresado al servicio
     */

    public function totalesdinero($id)
    {
        if (request()->expectsJson()) {
            $dineros = Service::findOrFail($id)->dineros->sum('monto');
            return  response()->json($dineros, 200);
        }
    }

    public function busqueda()
    {
        return new queryResource(Service::class);
    }

    //TODO no se que hace esta wea 
    // public function todosinforme()
    // {
    //     try {
    //         return Excel::download(new TodosTenicosExport(request()->all()), "informeTodosTecnicos " . Carbon::now() . ".xlsx");
    //     } catch (\Throwable $th) {
    //         return json_encode($th->getMessage());
    //     }
    // }

}
