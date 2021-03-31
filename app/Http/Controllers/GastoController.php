<?php

namespace App\Http\Controllers;

use App\Gasto;
use App\Http\Requests\GastoRequest;
use App\Http\Requests\gastosaveRequest;
use App\Http\Requests\GastoUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GastoController extends Controller
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
            return datatables(Gasto::where('service_id', $key)->toBase()->get())
                ->editColumn('action', function ($gasto) {
                    $button =  '<div class="text-lg-right text-nowrap">';
                    if (Auth::user()->hasRole('admin')) {
                        $button .=
                            '<a class="btn btn-circle btn-danger" href="javascript:void(0)" onclick="eliminarGasto(' . $gasto->id . ')"
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


        // return view('admin.gastos.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GastoRequest $request)
    {

        if (request()->expectsJson()) {
            try {
                Gasto::create(request()->all());
                return response()->json('Gasto registrado correctamente', 200);
            } catch (\Throwable $th) {
                return response()->json($th->getMessage(), 500);
            }
        }
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Transportes\Gasto  $gasto
     * @return \Illuminate\Http\Response
     */
    public function edit(Gasto $gasto)
    {
        if (request()->expectsJson()) {
            return response($gasto);
        }
        return abort(404);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Transportes\Gasto  $gasto
     * @return \Illuminate\Http\Response
     */

    public function show(Gasto $gasto)
    {
        return view('admin.gastos.show', compact('cliente'));
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
                $gasto = Gasto::findOrFail($request->id);
                $gasto->update(request()->all());
                return response()->json('Gasto actualizado correctamente');
            } catch (\Throwable $th) {
                return  response()->json($th->getMessage());
            }
        }
        return abort(404);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \Transportes\Gasto  $gasto
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (request()->expectsJson()) {
            try {
                Gasto::findOrFail($id)->delete();
                return response()->json('Gasto eliminado correctamente.');
            } catch (\Throwable $th) {
                return response()->json($th->getMessage());
            }
        }
        return abort(404);
    }
}
