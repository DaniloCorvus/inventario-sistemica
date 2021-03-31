<?php

namespace App\Http\Controllers;

use App\Tipo;
use App\Http\Requests\TipoSaveRequest;
use App\Http\Requests\TipoUpdateRequest;
use App\Services\ResponseTipo;

class TipoController extends Controller
{
    public function __construct(ResponseTipo $responseTipo)
    {
        //TODO Authorization
        $this->middleware(['auth']);
        $this->middleware(['can:get,App\User']);


        $this->responseTipo = $responseTipo;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->expectsJson()) {
            return $this->responseTipo->index();
        }


        return view('admin.tipos.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TipoSaveRequest $request)
    {

        if (request()->expectsJson()) {
            try {
                Tipo::create(request()->all());
                return response()->json('Tipo registrado correctamente');
            } catch (\Throwable $th) {
                return response()->json($th->getMessage(), 400);
            }
        }
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Transportes\Tipo  $tipo
     * @return \Illuminate\Http\Response
     */
    public function edit(Tipo $tipo)
    {
        if (request()->expectsJson()) {
            return response($tipo);
        }
        return abort(404);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Transportes\Tipo  $tipo
     * @return \Illuminate\Http\Response
     */

    public function show(Tipo $cliente)
    {
        return view('admin.tipos.show', compact('cliente'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(TipoUpdateRequest $request)
    {
        if (request()->expectsJson()) {
            try {
                $tipo = Tipo::findOrFail($request->id);
                $tipo->update(request()->all());
                return response()->json('Tipo actualizado correctamente');
            } catch (\Throwable $th) {
                return  response()->json($th->getMessage(), 400);
            }
        }
        return abort(404);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \Transportes\Tipo  $tipo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //TODO Arreglar
        if (request()->expectsJson()) {
            try {
                $tipo = Tipo::findOrFail($id);
                // if (count($tipo->services()->get()) != 0) {
                //     return response()->json('Existen servicios asocciados', 400);
                // }
                $tipo->delete();
                return response()->json('Tipo eliminado correctamente.');
            } catch (\Throwable $th) {
                return response()->json($th->getMessage(), 400);
            }
        }
        return abort(404);
    }
}
