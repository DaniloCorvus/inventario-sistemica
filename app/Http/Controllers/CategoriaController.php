<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Services\ResponseCategoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function __construct(ResponseCategoria $responseCategoria)
    {
        $this->middleware(['auth']);
        $this->responseCategoria = $responseCategoria;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->expectsJson()) {
            return $this->responseCategoria->index();

            // return  Categoria::orderBy('created_at', 'Desc')->get(['id', 'nombre', 'descripcion']);
        }
        return view('inventario.categorias.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if ($request->expectsJson()) {
            try {
                Categoria::create(request()->all());
                return response('Categoria registrado correctamente', 200);
            } catch (\Throwable $th) {
                return  json_encode($th->getMessage(), 500);
            }
        }
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Transportes\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        if ($request->expectsJson()) {
            $categoria = Categoria::findOrFail($id);
            return response($categoria, 200);
        }
        return abort(404);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Transportes\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */

    public function show(Request $request,  $key)
    {

        if ($request->expectsJson()) {
            $categoria = Categoria::findOrfail($key);
            return response($categoria, 200);
        }

        return view('inventario.categorias.show', compact('categoria'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if ($request->expectsJson()) {
            try {
                $categoria = Categoria::findOrFail($request->id);
                $categoria->update(request()->all());
                return response('Categoria actualizado correctamente', 200);
            } catch (\Throwable $th) {
                return  response($th->getMessage(), 500);
            }
        }
        return abort(404);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \Transportes\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if ($request->expectsJson()) {
            Categoria::findOrFail($id)->delete();
            return response('Categoria deleted successfully.');
        }
        return abort(404);
    }
}
