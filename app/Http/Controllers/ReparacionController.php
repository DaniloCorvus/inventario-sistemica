<?php

namespace App\Http\Controllers;

use App\Reparacion;
use App\Http\Requests\ReparacionSaveRequest;
use App\Http\Requests\ReparacionUpdateRequest;
use App\Services\ResponseReparacion;

class ReparacionController extends Controller
{
    public function __construct(ResponseReparacion $responseReparacion)
    {
        //TODO: Authorization
        $this->middleware(['auth']);
        $this->middleware(['can:get,App\User']);


        $this->responseReparacion = $responseReparacion;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->expectsJson()) {
            return $this->responseReparacion->index();
        }

        return view('admin.reparacion.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReparacionSaveRequest $request)
    {

        if (request()->expectsJson()) {
            try {
                Reparacion::create(request()->all());
                return response()->json('Reparacion registrado correctamente');
            } catch (\Throwable $th) {
                return response()->json($th->getMessage());
            }
        }
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Transportes\Reparacion  $Reparacion
     * @return \Illuminate\Http\Response
     */
    public function edit($key)
    {
        if (request()->expectsJson()) {
            $Reparacion = Reparacion::findOrFail($key);
            return response($Reparacion);
        }
        return abort(404);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Transportes\Reparacion  $Reparacion
     * @return \Illuminate\Http\Response
     */

    public function show(Reparacion $reparacion)
    {
        return view('admin.reparacion.show', compact('reparacion'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(ReparacionUpdateRequest $request)
    {
        if (request()->expectsJson()) {
            try {
                $Reparacion = Reparacion::findOrFail($request->id);
                $Reparacion->update(request()->all());
                return response()->json('Reparacion actualizado correctamente');
            } catch (\Throwable $th) {
                return  response()->json($th->getMessage(), 400);
            }
        }
        return abort(404);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \Transportes\Reparacion  $Reparacion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (request()->expectsJson()) {
            try {
                //TODO: Arreglar
                $Reparacion = Reparacion::findOrFail($id);
                // if (count($Reparacion->services()->get()) != 0) {
                //     return response()->json('Existen servicios asocciados', 400);
                // }
                $Reparacion->delete();
                return response()->json('Reparacion eliminado correctamente.');
            } catch (\Throwable $th) {
                return response()->json($th->getMessage(), 400);
            }
        }
        return abort(404);
    }
}
