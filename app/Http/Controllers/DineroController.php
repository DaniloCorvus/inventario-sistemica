<?php

namespace App\Http\Controllers;

use App\Dinero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DineroController extends Controller
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
            return datatables(Dinero::with('user')->where('service_id', $key)->latest())
                ->editColumn('action', function ($dinero) {
                    $button =  '<div class="text-lg-right text-nowrap">';

                    if (Auth::user()->hasRole('admin')) {
                        $button .=
                            '<a class="btn btn-circle btn-danger" href="javascript:void(0)" onclick="eliminarDinero(' . $dinero->id . ')"
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
    public function store(Request $request)
    {

        if (request()->expectsJson()) {
            try {
                Dinero::create(request()->all());
                return response()->json('Dinero registrado correctamente');
            } catch (\Throwable $th) {
                return response()->json($th->getMessage());
            }
        }
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Transportes\Dinero  $dinero
     * @return \Illuminate\Http\Response
     */
    public function edit(Dinero $dinero)
    {
        if (request()->expectsJson()) {
            return response($dinero);
        }
        return abort(404);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Transportes\Dinero  $dinero
     * @return \Illuminate\Http\Response
     */

    public function show(Dinero $dinero)
    {
        return view('admin.dineros.show', compact('cliente'));
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
                $dinero = Dinero::findOrFail($request->id);
                $dinero->update(request()->all());
                return response()->json('Dinero actualizado correctamente');
            } catch (\Throwable $th) {
                return  response()->json($th->getMessage());
            }
        }
        return abort(404);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \Transportes\Dinero  $dinero
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (request()->expectsJson()) {
            try {
                Dinero::findOrFail($id)->delete();
                return response()->json('Dinero eliminado correctamente.');
            } catch (\Throwable $th) {
                return response()->json($th->getMessage());
            }
        }
        return abort(404);
    }
}
