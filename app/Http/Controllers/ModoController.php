<?php

namespace App\Http\Controllers;

use App\Modo;
use App\Http\Requests\ModoSaveRequest;
use App\Http\Requests\ModoUpdateRequest;
use App\Services\ResponseModo;
use phpDocumentor\Reflection\Types\This;

class ModoController extends Controller
{
    public function __construct(ResponseModo $responseModo)
    {
        // TODO: Permisos
        $this->middleware(['auth']);
        $this->middleware(['can:get,App\User']);


        $this->response = $responseModo;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->expectsJson()) {
            return $this->response->index();
        }
        return view('admin.modos.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ModoSaveRequest $request)
    {

        if (request()->expectsJson()) {
            try {
                Modo::create(request()->all());
                return response()->json('Modo registrado correctamente');
            } catch (\Throwable $th) {
                return response()->json($th->getMessage(), 400);
            }
        }
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Transportes\Modo  $modo
     * @return \Illuminate\Http\Response
     */
    public function edit(Modo $modo)
    {
        if (request()->expectsJson()) {
            return response($modo);
        }
        return abort(404);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Transportes\Modo  $modo
     * @return \Illuminate\Http\Response
     */

    public function show(Modo $modo)
    {
        return view('admin.modos.show', compact('modo'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(ModoUpdateRequest $request)
    {
        if (request()->expectsJson()) {
            try {
                $modo = Modo::findOrFail($request->id);
                $modo->update(request()->all());
                return response()->json('Modo actualizado correctamente');
            } catch (\Throwable $th) {
                return  response()->json($th->getMessage(), 400);
            }
        }
        return abort(404);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \Transportes\Modo  $modo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // TODO: Arreglar esta wea
        if (request()->expectsJson()) {
            try {
                $modo = Modo::findOrFail($id);
                // if (count($modo->services()->get()) != 0) {
                //     return response()->json('Existen servicios asocciados', 400);
                // }
                $modo->delete();
                return response()->json('Modo eliminado correctamente.');
            } catch (\Throwable $th) {
                return response()->json($th->getMessage(), 500);
            }
        }
        return abort(404);
    }
}
