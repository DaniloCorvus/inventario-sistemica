<?php

namespace App\Http\Controllers;

use App\Repuesto;
use App\Proveedor;
use App\Accesorio;
use App\Historia;
use App\Http\Requests\RepuestoSaveRequest;
use App\Http\Requests\RepuestoUpdateRequest;
use App\Service;
use App\Services\CargaRepuesto;
use App\Services\ResponseRepuesto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RepuestoController extends Controller
{
    public function __construct(ResponseRepuesto $responseRepuesto)
    {
        $this->middleware(['auth']);
        $this->middleware(['can:get,App\User']);


        $this->responseRepuesto = $responseRepuesto;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->expectsJson()) {
            return $this->responseRepuesto->index();
        }

        $proveedores = Proveedor::toBase()->get();
        return view('admin.repuestos.index', compact('proveedores'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RepuestoSaveRequest $request)
    {

        if (request()->expectsJson()) {
            try {
                Repuesto::create(request()->all());
                return response()->json('Repuesto registrado correctamente');
            } catch (\Throwable $th) {
                return response()->json($th->getMessage(), 400);
            }
        }
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Transportes\Repuesto  $repuesto
     * @return \Illuminate\Http\Response
     */
    public function edit($repuesto)
    {
        if (request()->expectsJson()) {
            return Repuesto::with('services')->findOrFail($repuesto);
        }
        return abort(404);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Transportes\Repuesto  $repuesto
     * @return \Illuminate\Http\Response
     */

    public function show(Repuesto $cliente)
    {
        return view('admin.repuestos.show', compact('cliente'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(RepuestoUpdateRequest $request)
    {
        if (request()->expectsJson()) {
            try {
                $repuesto = Repuesto::findOrFail($request->id);
                $repuesto->update(request()->all());
                return response()->json('Repuesto actualizado correctamente');
            } catch (\Throwable $th) {
                return  response()->json($th->getMessage(), 400);
            }
        }
        return abort(404);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \Transportes\Repuesto  $repuesto
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (request()->expectsJson()) {
            try {
                Repuesto::findOrFail($id)->delete();
                return response()->json('Repuesto eliminado correctamente.');
            } catch (\Throwable $th) {
                return response()->json($th->getMessage(), 400);
            }
        }
        return abort(404);
    }


    public function eliminar($a, $s)
    {
        if (request()->expectsJson()) {
            try {

                $repuesto = Repuesto::findOrFail($a);
                $service = Service::findOrFail($s);

                Historia::create([
                    'descripcion' => 'Se ha eliminado repuesto ' . $repuesto->num_parte,
                    'user_id' => Auth::user()->id,
                    'service_id' => $service->id,
                ]);

                $service->repuestos()->detach(Repuesto::where('id', $repuesto->id)->first());

                $accesorio = Accesorio::where('repuesto_id', $repuesto->id)->where('service_id', $service->id)->first();
                $repuesto->cant_disponible =  ($repuesto->cant_disponible + $accesorio->cantidad);
                $repuesto->save();
                $accesorio->delete();

                // TODO revisar eliminar
                return response()->json('Operacion exitosa Eliminado de repuesto');
            } catch (\Throwable $th) {
                return  response()->json($th->getMessage(), 400);
            }
        }
        return abort(404);
    }

    public function carga(Request $request, CargaRepuesto $cargaRepuesto)
    {
        if (request()->expectsJson()) {

            $this->cargarepuesto = $cargaRepuesto;
            return $this->cargarepuesto->cargar();
        }
        return abort(404);
    }
}
