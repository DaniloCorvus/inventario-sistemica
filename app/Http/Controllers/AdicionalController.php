<?php

namespace App\Http\Controllers;

use App\Adicional;
use App\Http\Requests\AdicionalRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class AdicionalController extends Controller
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
    public function index($key)
    {
        if (request()->expectsJson()) {
            return DataTables::of(Adicional::where('service_id', $key)->latest())
                ->editColumn('action', function ($adicional) {
                    $button =  '<div class="text-lg-right text-nowrap">';
                    if (Auth::user()->hasRole('admin')) {
                        $button .=
                            '<a class="btn btn-circle btn-danger" href="javascript:void(0)" onclick="eliminarAdicional(' . $adicional->id . ')"
                        title="Eliminar">
                        <i class="fa fa-fw fa-trash"></i>
                        </a>';
                    }
                    $button .= '</div>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->toJson();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdicionalRequest $request)
    {

        if (request()->expectsJson()) {
            try {
                Adicional::create(request()->all());
                return response()->json('Adicional registrado correctamente');
            } catch (\Throwable $th) {
                return response()->json($th->getMessage());
            }
        }
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Transportes\Adicional  $adicional
     * @return \Illuminate\Http\Response
     */
    public function edit(Adicional $adicional)
    {
        if (request()->expectsJson()) {
            return response($adicional);
        }
        return abort(404);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Transportes\Adicional  $adicional
     * @return \Illuminate\Http\Response
     */

    public function show(Adicional $adicional)
    {
        return view('admin.adicionals.show', compact('cliente'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if (request()->expectsJson()) {
            try {
                $adicional = Adicional::findOrFail($request->id);
                $adicional->update(request()->all());
                return response()->json('Adicional actualizado correctamente');
            } catch (\Throwable $th) {
                return  response()->json($th->getMessage());
            }
        }
        return abort(404);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \Transportes\Adicional  $adicional
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (request()->expectsJson()) {
            try {
                Adicional::findOrFail($id)->delete();
                return response()->json('Adicional eliminado correctamente.');
            } catch (\Throwable $th) {
                return response()->json($th->getMessage());
            }
        }
        return abort(404);
    }
}
