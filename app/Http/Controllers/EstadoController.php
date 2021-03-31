<?php

namespace App\Http\Controllers;

use App\Estado;
use App\Http\Requests\EstadoSaveRequest;
use App\Http\Requests\EstadoUpdateRequest;
use Illuminate\Support\Facades\Auth;

class EstadoController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware(['can:get,App\User']);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (request()->expectsJson()) {
            return datatables(Estado::latest())
                ->editColumn('action', function ($estado) {
                    $button =  '<div class="text-lg-right text-nowrap">';
                    $button .=
                        '<a class="btn btn-circle btn-primary mr-1" href="javascript:void(0)" onclick="editarEstado(' . $estado->id . ')"
                        title="Editar">
                        <i class="fa fa-edit"></i>
                        </a>';
                    $button .=
                        '<a class="btn btn-circle btn-danger" href="javascript:void(0)" onclick="eliminarEstado(' . $estado->id . ')"
                        title="Eliminar">
                        <i class="fa fa-fw fa-trash"></i>
                        </a>';
                    $button .= '</div>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->toJson();
        }

        return view('admin.estados.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EstadoSaveRequest $request)
    {
        if (request()->expectsJson()) {
            try {
                Estado::create(request()->all());
                return response()->json('Estado registrado correctamente', 200);
            } catch (\Throwable $th) {
                return response()->json($th->getMessage(), 500);
            }
        }
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Transportes\Estado  $estado
     * @return \Illuminate\Http\Response
     */
    public function edit(Estado $estado)
    {
        if (request()->expectsJson()) {
            return response($estado, 200);
        }
        return abort(404);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Transportes\Estado  $estado
     * @return \Illuminate\Http\Response
     */

    public function show(Estado $cliente)
    {
        return view('admin.estados.show', compact('cliente'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(EstadoUpdateRequest $request)
    {
        if (request()->expectsJson()) {
            try {
                $estado = Estado::findOrFail($request->id);
                $estado->update(request()->all());
                return response()->json('Estado actualizado correctamente', 200);
            } catch (\Throwable $th) {
                return  response()->json($th->getMessage(), 500);
            }
        }
        return abort(404);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \Transportes\Estado  $estado
     * @return \Illuminate\Http\Response
     */

    // TODO implementar borrado con servicio
    public function destroy($id)
    {
        if (request()->expectsJson()) {
            try {
                $this->authorize('destroy', Estado::class);
                $estado = Estado::findOrFail($id);
                $estado->delete();
                return response()->json('Estado eliminado');
            } catch (\Throwable $th) {
                return response()->json($th->getMessage(), 400);
            }
        }
        return abort(404);
    }
}
