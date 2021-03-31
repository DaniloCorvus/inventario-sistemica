<?php

namespace App\Http\Controllers;

use App\Clausula;
use App\Http\Requests\ClausulaSaveRequest;
use App\Http\Requests\ClausulaUpdateRequest;
use App\Marca;
use App\Services\ResponseClausula;


class ClausulaController extends Controller
{
    public function __construct(ResponseClausula $responseClausula)
    {
        //TODO authprization
        $this->middleware(['auth']);
        $this->middleware(['can:get,App\User']);

        $this->responseClausula = $responseClausula;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->expectsJson()) {
            return $this->responseClausula->index();
        }

        $marcas = Marca::all();
        return view('admin.clausulas.index', compact('marcas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClausulaSaveRequest $request)
    {

        if (request()->expectsJson()) {
            try {
                Clausula::create(request()->all());
                return response()->json('Clausula registrado correctamente');
            } catch (\Throwable $th) {
                return response()->json($th->getMessage());
            }
        }
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Transportes\Clausula  $clausula
     * @return \Illuminate\Http\Response
     */
    public function edit(Clausula $clausula)
    {
        if (request()->expectsJson()) {
            return response($clausula);
        }
        return abort(404);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Transportes\Clausula  $clausula
     * @return \Illuminate\Http\Response
     */

    public function show(Clausula $clausula)
    {
        return view('admin.clausulas.show', compact('clausula'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(ClausulaUpdateRequest $request)
    {
        if (request()->expectsJson()) {
            try {
                $clausula = Clausula::findOrFail($request->id);
                $clausula->update(request()->all());
                return response()->json('Clausula actualizado correctamente');
            } catch (\Throwable $th) {
                return  response()->json($th->getMessage(), 400);
            }
        }
        return abort(404);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \Transportes\Clausula  $clausula
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (request()->expectsJson()) {
            try {
                Clausula::findOrFail($id)->delete();
                return response()->json('Clausula eliminado correctamente.');
            } catch (\Throwable $th) {
                return response()->json($th->getMessage(), 400);
            }
        }
        return abort(404);
    }
}
