<?php

namespace App\Http\Controllers;

use App\Marca;
use App\Http\Requests\MarcaSaveRequest;
use App\Http\Requests\MarcaUpdateRequest;
use App\Services\ResponseMarca;


class MarcaController extends Controller
{
    public function __construct(ResponseMarca $responseMarca)
    {
        //TODO : Authorizaion
        $this->middleware(['auth']);
        $this->middleware(['can:get,App\User']);

        $this->responseMarca = $responseMarca;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->expectsJson()) {
            return $this->responseMarca->index();
        }


        return view('admin.marcas.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MarcaSaveRequest $request)
    {

        if (request()->expectsJson()) {
            try {
                Marca::create(request()->all());
                return response()->json('Marca registrado correctamente', 200);
            } catch (\Throwable $th) {
                return response()->json($th->getMessage(), 500);
            }
        }
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Transportes\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function edit(Marca $marca)
    {
        if (request()->expectsJson()) {
            return response($marca);
        }
        return abort(404);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Transportes\Marca  $marca
     * @return \Illuminate\Http\Response
     */

    public function show(Marca $marca)
    {
        return view('admin.marcas.show', compact('marca'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(MarcaUpdateRequest $request)
    {
        if (request()->expectsJson()) {
            try {
                $marca = Marca::findOrFail($request->id);
                $marca->update(request()->all());
                return response()->json('Marca actualizado correctamente');
            } catch (\Throwable $th) {
                return  response()->json($th->getMessage(), 400);
            }
        }
        return abort(404);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \Transportes\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //TODO: arreglar
        if (request()->expectsJson()) {
            try {
                $marca = Marca::findOrFail($id);

                // if (count($marca->equipos()->get()) != 0 || count($marca->clausulas()->get()) != 0) {
                //     return response()->json('Existen Equipos o clausulas asocciadas', 400);
                // }
                $marca->delete();
                return response()->json('Marca eliminado correctamente.');
            } catch (\Throwable $th) {
                return response()->json($th->getMessage(), 400);
            }
        }
        return abort(404);
    }
}
