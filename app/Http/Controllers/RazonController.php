<?php

namespace App\Http\Controllers;

use App\Razon;
use App\Http\Requests\RazonSaveRequest;
use App\Http\Requests\RazonUpdateRequest;
use App\Services\ResponseRazon;

class RazonController extends Controller
{
    public function __construct(ResponseRazon $responseRazon)
    {
        //TODO: Authorization
        $this->middleware(['auth']);
        $this->middleware(['can:get,App\User']);


        $this->responseRazon = $responseRazon;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->expectsJson()) {
            return $this->responseRazon->index();
        }

        return view('admin.razons.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RazonSaveRequest $request)
    {

        if (request()->expectsJson()) {
            try {
                Razon::create(request()->all());
                return response()->json('Razon registrado correctamente');
            } catch (\Throwable $th) {
                return response()->json($th->getMessage(), 400);
            }
        }
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Transportes\Razon  $razon
     * @return \Illuminate\Http\Response
     */
    public function edit(Razon $razon)
    {
        if (request()->expectsJson()) {
            return response($razon);
        }
        return abort(404);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Transportes\Razon  $razon
     * @return \Illuminate\Http\Response
     */

    public function show(Razon $razon)
    {
        return view('admin.razons.show', compact('razon'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(RazonUpdateRequest $request)
    {
        if (request()->expectsJson()) {
            try {
                $razon = Razon::findOrFail($request->id);
                $razon->update(request()->all());
                return response()->json('Razon actualizado correctamente');
            } catch (\Throwable $th) {
                return  response()->json($th->getMessage(), 400);
            }
        }
        return abort(404);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \Transportes\Razon  $razon
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (request()->expectsJson()) {
            try {
                //TODO: arreglar esta wea
                $razon = Razon::findOrFail($id);
                // if (count($razon->services()->get()) != 0) {
                //     return response()->json('Existen servicios asocciados', 400);
                // }
                $razon->delete();
                return response()->json('Razon eliminado correctamente.');
            } catch (\Throwable $th) {
                return response()->json($th->getMessage(), 400);
            }
        }
    }
}
