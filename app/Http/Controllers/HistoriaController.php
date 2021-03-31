<?php

namespace App\Http\Controllers;

use App\Historia;
use App\Http\Requests\HistoriaSaveRequest;
use App\Http\Requests\HistoriaUpdateRequest;
use App\Services\HistoriaResponse;
use Illuminate\Http\Request;

class HistoriaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(HistoriaResponse $historiaResponse, $key)
    {
        if (request()->expectsJson()) {
            $this->historiaResponse = $historiaResponse;
            return  $this->historiaResponse->index($key);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HistoriaSaveRequest $request)
    {

        if (request()->expectsJson()) {
            try {
                Historia::create(request()->all());
                return response()->json('Historia registrado correctamente');
            } catch (\Throwable $th) {
                return response()->json($th->getMessage());
            }
        }
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Transportes\Historia  $historia
     * @return \Illuminate\Http\Response
     */
    public function edit(Historia $historia)
    {
        if (request()->expectsJson()) {
            return response($historia);
        }
        return abort(404);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Transportes\Historia  $historia
     * @return \Illuminate\Http\Response
     */

    public function show(Historia $cliente)
    {
        return view('admin.historias.show', compact('cliente'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(HistoriaUpdateRequest $request)
    {
        if (request()->expectsJson()) {
            try {
                $historia = Historia::findOrFail($request->id);
                $historia->update(request()->all());
                return response()->json('Historia actualizado correctamente');
            } catch (\Throwable $th) {
                return  response()->json($th->getMessage());
            }
        }
        return abort(404);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \Transportes\Historia  $historia
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (request()->expectsJson()) {
            try {
                Historia::findOrFail($id)->delete();
                return response()->json('Historia eliminado correctamente.');
            } catch (\Throwable $th) {
                return response()->json($th->getMessage());
            }
        }
        return abort(404);
    }
}
