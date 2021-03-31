<?php

namespace App\Http\Controllers;

use App\HappycallEstado;
use App\Http\Requests\RequestSaveHappycallEstado;
use App\Http\Requests\RequestUpdateHappycallEstado;
use App\Services\ResponseHappyCallEstado;
use Illuminate\Http\Request;

class HappycallEstadoController extends Controller
{
    public function __construct(ResponseHappyCallEstado $responseHappyCallEstado)
    {
        // TODO:Permisos
        $this->middleware(['auth']);
        $this->middleware(['can:get,App\User']);

        $this->response = $responseHappyCallEstado;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->expectsJson()) {
            return  $this->response->index();
        }
        return view('admin.happycallestados.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestSaveHappycallEstado $request)
    {

        if (request()->expectsJson()) {
            try {
                HappycallEstado::create(request()->all());
                return response()->json('HappycallEstado registrado correctamente');
            } catch (\Throwable $th) {
                return response()->json($th->getMessage(), 400);
            }
        }
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Transportes\HappycallEstado  $HappycallEstado* @return \Illuminate\Http\Response
     */
    public function edit($key)
    {
        if (request()->expectsJson()) {
            $HappycallEstado = HappycallEstado::findOrFail($key);
            return response($HappycallEstado);
        }
        return abort(404);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Transportes\HappycallEstado  $HappycallEstado* @return \Illuminate\Http\Response
     */

    public function show(HappycallEstado $HappycallEstado)
    {
        return view('admin.happycallestados.show', compact('HappycallEstado'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(RequestUpdateHappycallEstado $request)
    {
        if (request()->expectsJson()) {
            try {
                $happycallEstado = HappycallEstado::findOrFail(request()->id);
                $happycallEstado->update(request()->all());
                return response()->json('HappycallEstado actualizado correctamente');
            } catch (\Throwable $th) {
                return  response()->json($th->getMessage(), 400);
            }
        }
        return abort(404);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \Transportes\HappycallEstado  $HappycallEstado* @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (request()->expectsJson()) {
            try {
                $happycallEstado = HappycallEstado::findOrFail($id);
                $happycallEstado->delete();
                return response()->json('HappycallEstado eliminado correctamente.');
            } catch (\Throwable $th) {
                return response()->json($th->getMessage(), 400);
            }
        }
        return abort(404);
    }
}
