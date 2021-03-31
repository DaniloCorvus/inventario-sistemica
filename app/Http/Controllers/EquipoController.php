<?php

namespace App\Http\Controllers;


use App\Equipo;

use App\Http\Requests\EquipoSaveRequest;
use App\Http\Requests\EquipoUpdateRequest;
use App\Http\Resources\equipoResponse;
use App\Services\ResponseEquipo;
use Illuminate\Support\Facades\Cache;

class EquipoController extends Controller
{
    public function __construct(ResponseEquipo $responseEquipo)
    {
        $this->middleware('auth');
        $this->middleware(['can:get,App\User']);

        $this->responseEquipo = $responseEquipo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->expectsJson()) {
            return $this->responseEquipo->index();
        }

        return  new equipoResponse(Equipo::class);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EquipoSaveRequest $request)
    {

        if (request()->expectsJson()) {
            try {
                Equipo::create(request()->all());
                Cache::forget('equiposCache');
                return response()->json('Equipo registrado correctamente', 200);
            } catch (\Throwable $th) {
                return response()->json($th->getMessage(), 500);
            }
        }
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Transportes\Equipo  $equipo
     * @return \Illuminate\Http\Response
     */
    public function edit(Equipo $equipo)
    {
        if (request()->expectsJson()) {
            return response($equipo, 200);
        }
        return abort(404);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Transportes\Equipo  $equipo
     * @return \Illuminate\Http\Response
     */

    public function show(Equipo $equipo)
    {

        return view('admin.equipos.show', compact('cliente'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(EquipoUpdateRequest $request)
    {
        if (request()->expectsJson()) {
            try {
                $equipo = Equipo::findOrFail($request->id);
                $equipo->update(request()->all());
                Cache::forget('equiposCache');
                return response()->json('Equipo actualizado correctamente');
            } catch (\Throwable $th) {
                return  response()->json($th->getMessage(), 400);
            }
        }
        return abort(404);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \Transportes\Equipo  $equipo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (request()->expectsJson()) {
            try {
                $equipo = Equipo::findOrFail($id);
                // if (count($equipo->services()->get()) != 0) {
                //     return response()->json('Existen servicios asocciados', 400);
                // }
                $equipo->delete();
                Cache::forget('equiposCache');
                return response()->json('Equipo eliminado correctamente.');
            } catch (\Throwable $th) {
                return response()->json($th->getMessage(), 400);
            }
        }
        return abort(404);
    }

    public function serviciosEquipo($equipo)
    {
        //TODO servicios en equipo

        // if (request()->expectsJson()) {
        //     return datatables(Service::where('equipo_id', $equipo)->with('cliente', 'user', 'equipo', 'estado', 'modo', 'tipo', 'razon')->get())
        //         ->editColumn('action', function ($service) {
        //             $button =  '<div class="text-lg-right text-nowrap">';
        //             $button .=
        //                 '<a class="btn btn-circle btn-primary mr-1" href="/services/' . $service->id . '"
        //             title="Editar">
        //             <i class="fa fa-eye"></i>
        //             </a>';
        //             $button .=
        //                 '<a class="btn btn-circle btn-warning mr-1" target="blank" href="/services/printservice/' . $service->id . '"
        //             title="Imprimir">
        //             <i class="fa fa-fw fa-print"></i>
        //             </a>';
        //             $button .=
        //                 '<a class="btn btn-circle btn-danger" href="javascript:void(0)" onclick="eliminarService(' . $service->id . ')"
        //             title="Eliminar">
        //             <i class="fa fa-fw fa-trash"></i>
        //             </a>';
        //             $button .= '</div>';
        //             return $button;
        //         })->setRowClass(function ($service) {

        //             switch ($service->razon->id) {
        //                 case 1:
        //                     return 'bg-info';
        //                     break;
        //                 case 2:
        //                     return 'bg-warning';
        //                     break;
        //                 case 3:
        //                     return 'bg-default ';
        //                     break;
        //                 case 4:
        //                     return 'alert-success ';
        //                     break;
        //                 case 5:
        //                     return 'alert-danger ';
        //                     break;
        //                 default:
        //                     return 'alert-warning ';
        //             }
        //         })
        //         ->rawColumns(['action'])
        //         ->addIndexColumn()
        //         ->toJson();
        // }

        return  new equipoResponse(Equipo::class, 'servicios');
    }

    public function query($referencia)
    {
        if (Equipo::where('referencia', $referencia)->first()) {
            return response()->json(true);
        }
        return response()->json(false);
    }

    public function minihistoria()
    {
        if (request()->wantsJson()) {
            return response(
                Equipo::find(request('equipo'))->services()
                    ->with('repuestos', 'cliente:id,nombre,apellido,identificacion')
                    ->select('id', 'fecha_reparado', 'fecha_finalizado', 'reporte', 'valor_cargo_cliente', 'fecha_inicio', 'cliente_id')
                    ->get()
            );
        }
    }
}
