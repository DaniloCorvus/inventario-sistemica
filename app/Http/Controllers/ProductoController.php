<?php

namespace App\Http\Controllers;

use App\Producto;
use App\Http\Requests\ProductoSaveRequest;
use App\Http\Requests\ProductoUpdateRequest;
use App\Services\ResponseProducto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function __construct(ResponseProducto $responseProducto)
    {
        //TODO Authorization
        $this->middleware(['auth']);
        $this->middleware(['can:get,App\User']);


        $this->responseProducto = $responseProducto;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->expectsJson()) {
           return $this->responseProducto->index();
        }


        return view('admin.productos.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductoSaveRequest $request)
    {

        if (request()->expectsJson()) {
            try {
                Producto::create(request()->all());
                return response()->json('Producto registrado correctamente');
            } catch (\Throwable $th) {
                return response()->json($th->getMessage(), 400);
            }
        }
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Transportes\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit(Producto $producto)
    {
        if (request()->expectsJson()) {
            return response($producto);
        }
        return abort(404);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Transportes\Producto  $producto
     * @return \Illuminate\Http\Response
     */

    public function show(Producto $cliente)
    {
        return view('admin.productos.show', compact('cliente'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(ProductoUpdateRequest $request)
    {
        if (request()->expectsJson()) {
            try {
                $producto = Producto::findOrFail($request->id);
                $producto->update(request()->all());
                return response()->json('Producto actualizado correctamente', 200);
            } catch (\Throwable $th) {
                return  response()->json($th->getMessage(), 500);
            }
        }
        return abort(404);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \Transportes\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (request()->expectsJson()) {
            try {
                //TODO arreglar esto
                $producto = Producto::findOrFail($id);
                // if (count($producto->services()->get()) != 0) {
                //     return response()->json('Existen equipos asocciados', 400);
                // }
                $producto->delete();
                return response()->json('Producto eliminado correctamente.');
            } catch (\Throwable $th) {
                return response()->json($th->getMessage(), 400);
            }
        }
        return abort(404);
    }
}
