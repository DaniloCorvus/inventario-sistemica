<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use Illuminate\Http\Request;
// use App\Http\Requests\VentaSaveRequest;
// use App\Http\Requests\VentaUpdateRequest;
use App\Imports\VentasImport;
use App\Cliente;
use App\Models\Cellar;
use App\Models\Detalle;
//use App\Models\Producto;
use App\Services\ResponseVenta;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class VentaController extends Controller
{
    public function __construct(ResponseVenta $responseVenta)
    {
        //TODO Authorization
        $this->middleware(['auth']);
        $this->responseVenta = $responseVenta;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->expectsJson()) {
            return  $this->responseVenta->index();
        }
        $clientes = Cliente::get(['nombre', 'apellido', 'id']);
 ;
        return view('inventario.ventas.index', compact('clientes'));
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

                DB::beginTransaction();

              /*   foreach (request()->get(4)['productos'] as $prodcuto) {
                    //$query =  ' SELECT  Cantidad_Disponible '
                    $prodcutox = Producto::findOrFail($prodcuto['producto']['id']);
                    if ($prodcutox->cant_disponible < $prodcuto['cantidad']) {
                        return response()->json("La cantidad ingresada del producto $prodcutox->descripcion es mayor a la que esta en stock ", 400);
                    }
                } */

                $venta =   Venta::create([
                    'total_bruto'   => request()->get(0)['total_bruto'],
                    'impuesto'      => request()->get(1)['impuesto'],
                    'total'         => request()->get(2)['total'],
                    'cliente_id'    => request()->get(3)['cliente_id'],
                    'observaciones' => request()->get(4)['observaciones'],
                    'num_factura' => request()->get(5)['num_factura'],
                ]);

                foreach (request()->get(6)['productos'] as $prod) {
                    foreach ($prod['series'] as  $serie) {
                        # code...
                        //dd($serie['inventario']['id']);
                        Detalle::create([
                            'cantidad'       => $serie['seleccionado'],
                            'precio'         => $prod['producto']['costo_venta'],
                            'inventario_id'  => $serie['inventario']['id'],
                            'venta_id'       => $venta->id
                        ]);

                    }
                }

                
         //       $detalles = $venta->detalles()->with('inventario')->with('producto')->get();
                $detalles = $venta->detalles()->with([
                   /*  'detalles' => function($query) {
                        $query->select('id', 'cantidad','precio','inventario_id'); # Muchos a muchos
                    },  */
                    'inventario' => function($query) {
                        $query->select('id', 'productox_id','serie'); # Muchos a muchos
                    }, 
                    'inventario.producto' => function($query) {
                        $query->select('id', 'descripcion', 'modelo' ); # Uno a muchos
                    }
                    ])->get();

                $cliente = $venta->cliente()->first();
              #  dd($detalles[0]->inventario->producto->modelo);exit;
               # return view('pdfs.remision', compact('venta', 'detalles','cliente'));
                $pdf = PDF::loadView('pdfs.remision', compact('venta', 'detalles','cliente'))
                    ->save(public_path("pdfs/remision.pdf"));
                DB::commit();
                return  response()->download(public_path("/pdfs/remision.pdf"))->deleteFileAfterSend(true);
            } catch (\Throwable $th) {
                DB::rollBack();
                return response()->json($th->getMessage(), 400);
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Transportes\Venta  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit(Venta $producto)
    {
        if (request()->expectsJson()) {
            return response($producto);
        }
        return abort(404);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Transportes\Venta  $producto
     * @return \Illuminate\Http\Response
     */

    public function show(Venta $pedido)
    {

        return view('inventario.ventas.show', compact('pedido'));
    }

    public function create()
    {
        $bodegas = Cellar::select('id', 'nombre')->get();
       
        $clientes = Cliente::get(['nombre', 'apellido', 'id']);
        return view('inventario.ventas.partials.formRegister', compact('clientes','bodegas'));
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
                $producto = Venta::findOrFail($request->id);

                $producto->update(request()->all());

                return response()->json('Venta actualizado correctamente', 200);
            } catch (\Throwable $th) {
                return  response()->json($th->getMessage(), 500);
            }
        }
        return abort(404);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \Transportes\Venta  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (request()->expectsJson()) {
            try {
                //TODO arreglar esto
                $producto = Venta::findOrFail($id);
                // if (count($producto->services()->get()) != 0) {
                //     return response()->json('Existen equipos asocciados', 400);
                // }
                $producto->delete();
                return response()->json('Venta eliminado correctamente.');
            } catch (\Throwable $th) {
                return response()->json($th->getMessage(), 400);
            }
        }
        return abort(404);
    }

    public function buscarCodigo()
    {
        if (request()->expectsJson()) {
            try {
                return Venta::where('codigo', request()->get('codigo'))->first();
            } catch (\Throwable $th) {
                return response()->json($th->getMessage(), 400);
            }
        }
        return abort(404);
    }
}
