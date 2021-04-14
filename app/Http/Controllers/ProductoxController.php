<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use App\Http\Requests\ProductoSaveRequest;
use App\Http\Requests\ProductoUpdateRequest;
use App\Http\Requests\ProductoxSaveRequest;
use App\Imports\ProductosImport;
use App\Models\Cellar;
use App\Proveedor;
use App\Services\ResponseProductox;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ProductoxController extends Controller
{
    public function __construct(ResponseProductox $responseProducto)
    {
        //TODO Authorization
        $this->middleware(['auth']);
        // $this->middleware(['can:get,App\User']);
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
        // return  Producto::orderBy('created_at', 'Desc')->get([
        //     'id',
        //     'proveedor_id',
        //     'pedido_id',
        //     'cellar_id',
        //     'serie',
        //     'modelo',
        //     'num_pedido',
        //     'descripcion',
        //     'num_factura',
        //     'fecha_compra',
        //     'fecha_recibido',
        //     'fecha_solicitud',
        //     'guia',
        //     'orden_compra',
        //     'cod_interno',
        //     'delivery_orden',
        //     'confirmacion',
        //     'num_parte',
        //     'costo_in',
        //     'costo_antes_iva',
        //     'costo_promosion',
        //     'costo_venta',
        //     'impuesto',
        //     'cantidad',
        //     'costo_total',
        //     'cant_disponible',
        //     'ubicacion',
        //     'observacion',
        //     'estado',
        //     'codigo',
        // ]);



        return view('inventario.productos.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductoxSaveRequest  $request)
    {

      ///  dd(request()->all());
        // if (request()->expectsJson()) {
        try {
            Producto::create(request()->all());
            return response()->json('Producto registrado correctamente');
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 400);
            // }
        }
        // return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Transportes\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $producto = Producto::FindOrfail($id);
        $proveedores = Proveedor::select('id', 'nombre')->get();
        $bodegas = Cellar::select('id', 'nombre')->get();
        return view('inventario.
        productos.partials.formUpdate', compact('producto', 'proveedores', 'bodegas'));
    }

    public function actualizarEstado()
{
    if (request()->expectsJson()) {


        $prod = Producto::find(request()->get('id'));
        $prod->estado = request()->get('estado');
       # dd($prod->estado);
        $prod->save();


         return response()->json(['data'=>'actualizado con éxito']);

     }else{
         return abort(404);
     }

}
    public function create()
    {
        $proveedores = Proveedor::select('id', 'nombre')->get();
        $bodegas = Cellar::select('id', 'nombre')->get();
        return view('inventario.productos.partials.formRegister', compact('proveedores', 'bodegas'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Transportes\Producto  $producto
     * @return \Illuminate\Http\Response
     */

    public function show(Producto $pedido)
    {
        return view('admin.productos.show', compact('pedido'));
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

        public function buscarCodigo()
        {
            if (request()->expectsJson()) {
                try {
                    return Producto::where('codigo', request()->get('codigo') )->first();
                } catch (\Throwable $th) {
                    return response()->json($th->getMessage(), 400);
                }
        }
        return abort(404);
    }


    public function buscarCodigox()
    {
        if (request()->expectsJson()) {
            try {
                return Producto::where('codigo', request()->get('codigo'))->where('cant_disponible', '>', 0)->first();
            } catch (\Throwable $th) {
                return response()->json($th->getMessage(), 400);
            }
        }
        return abort(404);
    }

    public function import()
    {
        Excel::import(new ProductosImport, request()->file('prodcuts'));
        return back()->with('success', 'All good!');
        // return redirect('/')
    }

    public function ventas($id){
        $producto = Producto::find($id);
        $query = 'SELECT SUM(D.cantidad) AS cantidad, SUM(D.precio * D.cantidad) AS total , D.precio,
                     V.num_factura, V.created_at as fecha, V.id AS venta_id,
                    CONCAT_WS(" ",C.nombre,C.Apellido) as cliente
                    FROM detalles D
                    INNER JOIN inventario I ON I.id = D.inventario_id
                    INNER JOIN ventas V ON V.id = D.venta_id
                    INNER JOIN clientes C ON C.id = V.cliente_id
                    WHERE I.productox_id = '.$id.'
                    GROUP BY V.id';
        $ventas = DB::select($query);

        return view('inventario.productoventas.index', compact('ventas','producto'));
    }
}
