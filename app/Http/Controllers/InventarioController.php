<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\InventarioSaveRequest;
use App\Models\CargueInventario;
use App\Models\Cellar;
use App\Models\Inventario;
use App\Models\Proveedor;
use App\Productox;
use App\Services\ResponseInventario;
use App\Services\CargueInventarioService;
use Exception;
use Illuminate\Http\Request;

class InventarioController extends Controller
{
    public function __construct( ResponseInventario $responseInventario )
    {
        //TODO Authorization
        $this->middleware(['auth']);
        // $this->middleware(['can:get,App\User']);
        $this->responseInventario = $responseInventario;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (request()->expectsJson()) {
            
            return $this->responseInventario->index();
        }

        return view('inventario.inventario.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $proveedores = Proveedor::select('id', 'nombre')->get();
        $bodegas = Cellar::select('id', 'nombre')->get();
        return view('inventario.inventario.partials.formRegister', compact('proveedores', 'bodegas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(InventarioSaveRequest  $request)
    {
        if (request()->expectsJson()) {

            try {
                
                $dataProduct = json_decode(Request()->producto);
                $dataCargue = $this->reqDataCargue($dataProduct);

                $inventario = Inventario::where('productox_id',$dataProduct->id)
                                ->where('cellar_id',$dataCargue['cellar_id'])
                                ->where('serie',$dataCargue['serie'])
                                ->first();
    
                if($inventario){
                    if($dataCargue['estado'] == 'recibido' ){
                        $inventario->cantidad_disponible += $dataCargue['cantidad'];
                    }else{
                        $inventario->cantidad += $dataCargue['cantidad'];
                    }

                    $inventario->save();
                    $dataCargue['inventario_id'] = $inventario->id;
                }else{
                  /*   $inventario */
                  $dataCargue['inventario_id']  = Inventario::create([
                    'productox_id' => $dataCargue['productox_id'] ,
                    'cantidad' => $dataCargue['cantidad'],
                    'serie' => $dataCargue['serie'],
                    'cellar_id' => $dataCargue['cellar_id'],
                  ])->id;
            
                }

                unset($dataCargue['serie']);
                unset($dataCargue['cellar_id']);
                CargueInventario::create($dataCargue);
                return response()->json('Producto registrado correctamente',200);

            } catch (\Throwable $th) {
              return response()->json($th->getMessage(), 400);
            }
        }
        // return abort(404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function reqDataCargue($product){
       
        $dataCargue = request()->only([ 
            "proveedor_id",
           "estado" ,
           "serie",
           "num_pedido" ,
           "guia" ,
           "num_factura" ,
           "fecha_compra" ,
           "fecha_solicitud" ,
           "orden_compra" ,
           "delivery_orden" ,
           "confirmacion" ,
           "costo_antes_iva" ,
           "impuesto" ,
           "costo_in" ,
           "cantidad" ,
           "costo_total" ,
           "costo_venta" ,
           "ubicacion" ,
           "cellar_id" ,
           "observacion"
           ]);

        $Cargue = new CargueInventarioService();
        $dataCargue['costo_in'] =  $Cargue->castFloats( $dataCargue['costo_in'] );
        $dataCargue['costo_venta'] =  $Cargue->castFloats( $dataCargue['costo_venta'] );
        $dataCargue['costo_total'] =  $Cargue->castFloats( $dataCargue['costo_total'] );
        $dataCargue['costo_antes_iva'] =  $Cargue->castFloats( $dataCargue['costo_antes_iva'] );
        $dataCargue['costo_antes_iva'] =  $Cargue->castFloats( $dataCargue['costo_antes_iva'] );
        
        $dataCargue['productox_id'] = $product->id;
        return $dataCargue;
    }

    public function buscarProducto(){
        $request = Request()->all();
      /*   if (request()->expectsJson()) { */
          
            try {
                $producto = Productox::where('codigo', '=', $request['codigo'] )->first();
                if ($producto) {
                    $sql = ' SELECT i.* 
                                FROM inventario i 
                                 WHERE i.productox_id = '.$producto->id.'
                                AND cellar_id = '.$request['cellar_id'] . ' AND cantidad_disponible >  0 ' ;
                    $inventario  =  DB::select($sql);
                   
                    if(!$inventario){
                        throw new Exception("No hay cantidades disponibles", 1);                
                    }
                    $total = 0;
                    foreach ($inventario as $key => $value) {
                        # code...
                        $total += $value->cantidad_disponible;
                    }

                    $sql = ' SELECT c.costo_venta FROM cargues_inventario c 
                             WHERE c.estado = "recibido"
                     ORDER BY c.fecha_compra DESC LIMIT 1' ;
                    $cargue  =  DB::select($sql);

                    $producto['total'] = $total;
                    $producto['costo_venta'] = $cargue[0]->costo_venta;
                    $producto['valor_total'] = $cargue[0]->costo_venta;
                    $producto['inventario'] = $inventario;
                  
                    return response()->json($producto);
                }else{
                    throw new Exception("El Producto no existe", 1);                
                }
            } catch (\Exception $th) {
                return response()->json($th->getMessage(),400);
              
            }



        /* }
        return abort(404); */
       
    }


    public function buscarCantidad(){

    }
}
