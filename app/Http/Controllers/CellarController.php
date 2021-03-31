<?php

namespace App\Http\Controllers;

use App\Http\Requests\CellarStoreRequest;
use App\Http\Requests\CellarUpdateRequest;
use App\Models\Cellar;
use App\Models\Producto;
use App\Repositories\CellarRepository;

class CellarController extends Controller
{

    private $repository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(CellarRepository $CellarRepository)
    {
        $this->repository = $CellarRepository;
    }

    public function index()
    {
        if (request()->wantsJson()) {
            return $this->repository->all();
        }
        return view('inventario.cellars.index');
    }
    
    public function show($id)
    {
        try {
            $Cellar = $this->repository->find($id);
            if (null == $Cellar) {
                return response()->json('Cellar no found',  404);
            }
            return response()->json($Cellar,  200);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(),  500);
        }
    }
    
    public function store(CellarStoreRequest $CellarRequest)
    {
        try {
            $this->repository->Create($CellarRequest->all());
            return response()->json('Creado correcto',  200);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(),  500);
        }
    }
    
    public function update(CellarUpdateRequest $CellarUpdateRequest, $id)
    {
        try {
            if ($this->repository->update($CellarUpdateRequest->all(), $id)) {
                return response()->json('Update Correcto',  200);
            }
            return response()->json('Operacion no realizada. Posible error: Cellar no found',  404);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(),  500);
        }
    }
    
    public function destroy($id)
    {
        try {
            if (($this->repository->delete($id))) {
                return response()->json('Eliminado Correcto',  200);
            }
            return response()->json('Operacion no realizada. Posible error: Cellar no found',  404);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(),  500);
        }
    }
    
    public function verProductos($id)
    {
        if (request()->expectsJson()) {
            return datatables(Cellar::findOrFail($id)->productos()->get())
                ->addIndexColumn()
                ->toJson();
            }
            return view('inventario.cellars.productos', compact('id'));
        }
    }
    