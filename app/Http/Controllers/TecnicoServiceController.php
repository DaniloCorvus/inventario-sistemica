<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ResponseService;

use App\Cliente;
use App\Equipo;

class TecnicoServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aux = new  ResponseService;

        $services = $aux->indexTecnico();
        $clientes = Cliente::OrderBy('nombre', 'Asc')->toBase()->get(['nombre', 'apellido', 'identificacion', 'id']);
        $equipos = Equipo::OrderBy('serie', 'Asc')->toBase()->get(['serie', 'id']);
        
        return view('admin.services.index', compact('services','clientes','equipos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function destroy($id)
    {
        //
    }
}
