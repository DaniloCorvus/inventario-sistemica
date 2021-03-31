<?php

namespace App\Http\Controllers;

use App\Proveedor;
use App\Http\Requests\ProveedorSaveRequest;
use App\Http\Requests\ProveedorUpdateRequest;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth'])->except('index');
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
            return datatables(Proveedor::latest())
                ->editColumn('action', function($proveedor){
                    $button =  '<div class="text-lg-right text-nowrap">';
                    $button .=
                    '<a class="btn btn-circle btn-primary mr-1" href="javascript:void(0)" onclick="editarProveedor('.$proveedor->id.')"
                    title="Editar">
                    <i class="fa fa-edit"></i>
                    </a>';
                    $button .=
                    '<a class="btn btn-circle btn-danger" href="javascript:void(0)" onclick="eliminarProveedor('.$proveedor->id.')"
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


        return view('admin.proveedors.index');
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
                Proveedor::create(request()->all());
                return response()->json('Proveedor registrado correctamente', 200);
            } catch (\Throwable $th) {
                return response()->json($th->getMessage(), 500);
            }
        }
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Transportes\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function edit(Proveedor $proveedor)
    {
        if (request()->expectsJson()) {
            // $proveedor = Proveedor::findOrFail($id);
            return response($proveedor, 200);
        }
        return abort(404);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Transportes\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */

    public function show(Proveedor $proveedor)
    {
        // $proveedor = Proveedor::findOrfail($key);
        return view('admin.proveedors.show', compact('proveedor'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    //  TODO ProveedorUpdateRequest
    public function update(Request $request)
    {
        if (request()->expectsJson()) {
            try {
                $proveedor = Proveedor::findOrFail($request->id);
                $proveedor->update(request()->all());
                return response()->json('Proveedor actualizado correctamente', 200);
            } catch (\Throwable $th) {
                return  response()->json($th->getMessage(), 500);
            }
        }
        return abort(404);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \Transportes\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (request()->expectsJson()) {
            try {
                Proveedor::findOrFail($id)->delete();
                return response()->json('Proveedor eliminado correctamente.', 200);
            } catch (\Throwable $th) {
                return response()->json($th->getMessage(), 500);
            }
        }
        return abort(404);
    }
}
