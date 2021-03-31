<?php

namespace App\Http\Controllers;
use App\Http\Requests\HistoriaSaveRequest;
use Illuminate\Http\Request;
use App\Models\HistoriaVenta;
use App\Services\HistoriaVentaResponse;


class HistoriaVentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(HistoriaVentaResponse $historiaResponse, $key)
    {
        if (request()->expectsJson()) {
          
            $this->historiaResponse = $historiaResponse;
            return  $this->historiaResponse->index($key);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        if (request()->expectsJson()) {
            try {
              //dd(request()->all());
                HistoriaVenta::create(request()->all());
                return response()->json('Historia registrado correctamente');
            } catch (\Throwable $th) {
                return response()->json($th->getMessage());
            }
        }
        return abort(404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if ($request->expectsJson()) {
            HistoriaVenta::findOrFail($id)->delete();
            return response('Historia Eliminada correctamente.');
        }
        return abort(404);
    }
}
