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

            $id = request()->id ? request()->id : '';


            return $this->responseInventario->index($id);
        }
        $bodegas = Cellar::select('id', 'nombre')->get();

        return view('inventario.inventario.index',compact('bodegas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $proveedores = Proveedor::select('id', 'nombre')->get();
        $bodegas = Cellar::select('id', 'nombre')->where('estado','activo')->get();
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
                                ->where('ubicacion',trim($dataCargue['ubicacion']))
                                ->first();
                if($inventario){
                    if($dataCargue['estado'] == 'recibido' ){
                        $inventario->cantidad_disponible += $dataCargue['cantidad'];
                        $inventario->cantidad += $dataCargue['cantidad'];
                    }

                    $inventario->save();
                    $dataCargue['inventario_id'] = $inventario->id;
                }else{
                  /*   $inventario */
                  $disponible = $dataCargue['estado'] == 'recibido' ? $dataCargue['cantidad'] : 0;
                  $dataCargue['inventario_id']  = Inventario::create([
                    'productox_id' => $dataCargue['productox_id'] ,
                    'cantidad' => $disponible,
                    'cantidad_disponible' => $disponible,
                    'serie' => $dataCargue['serie'],
                    'ubicacion' => trim($dataCargue['ubicacion']),
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
                    if($producto->estado != 'activo' )  throw new Exception("El Producto no se encuentra activo", 1);
                    $sql = ' SELECT i.*
                                FROM inventario i
                                 WHERE i.productox_id = '.$producto->id.'
                                AND cellar_id = '.$request['cellar_id'] . ' AND cantidad_disponible >  0 ' ;
                    $inventario  =  DB::select($sql);
                    if(!$inventario){
                        throw new Exception("No hay cantidades disponibles", 1);
                    }
                    $last = $inventario[count($inventario)-1];
                    $total = 0;
                    foreach ($inventario as $key => $value) {
                        # code...
                        $total += $value->cantidad_disponible;
                    }


                    $sql = ' SELECT c.id, c.costo_venta FROM cargues_inventario c
                        WHERE c.estado = "recibido" AND c.inventario_id='.$last->id.'
                     ORDER BY c.id DESC LIMIT 1' ;
                    $cargue  =  DB::select($sql);
                    $producto['total'] = $total;
                    if($cargue){

                        $producto['costo_venta'] = $cargue[0]->costo_venta;
                        $producto['valor_total'] = $cargue[0]->costo_venta;
                    }else{
                        $producto['costo_venta'] = 0;
                        $producto['valor_total'] = 0;

                    }
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

    public function traslado(){
        if (request()->expectsJson()) {

            try {
                //code...
                $request = Request()->all();
                return $this->responseInventario->traslado($request);
                dd($request);

                return response()->json(200);

            } catch (\Throwable $th) {
                //throw $th;
                return response()->json(['errors'=>$th->getMessage()],400);
            }

        }

        $bodegas = Cellar::select('id', 'nombre')->get();

        return view('inventario.traslado.index',compact('bodegas'));

    }

    public function buscarCantidad(){

    }

    public function trasladar(){

        try {
            //code...
            $data = Request()->all();


        $data['productos'] = json_decode($data['productos'],true);

        foreach ($data['productos'] as $key => $producto) {
            # code...
            if($producto['nueva_cantidad'] && $producto['nueva_cantidad'] > 0 ){


                $inventario = Inventario::find($producto['id']);

                $traslado = Inventario::where('cellar_id',$data['to_cellar_id'])
                                        ->where('serie',$inventario->serie)
                                        ->where('productox_id',$inventario->productox_id)
                                        ->where('ubicacion',$producto['nueva_ubicacion'])
                                        ->first();

                if($traslado){
                    $traslado->cantidad_disponible += $producto['nueva_cantidad'];
                    $traslado->save();
                }else{
                    $traslado = new Inventario();
                    $traslado->productox_id = $inventario->productox_id;
                    $traslado->serie = $inventario->serie;
                    $traslado->cellar_id = $data['to_cellar_id'];
                    $traslado->cantidad_disponible = $producto['nueva_cantidad'];
                    $traslado->cantidad = $producto['nueva_cantidad'];
                    $traslado->ubicacion = $producto['nueva_ubicacion'];
                    $traslado->save();

                }
                $saveCantidad = $inventario->cantidad - $producto['nueva_cantidad'];
                $inventario->cantidad = $saveCantidad < 0 ? 0 : $saveCantidad;

                $saveCantidadDis = $inventario->cantidad_disponible - $producto['nueva_cantidad'];
                $inventario->cantidad_disponible = $saveCantidadDis < 0 ? 0 : $saveCantidadDis;

                $inventario->save();

                return response()->json('exitoso',200);
            }
        }
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json($th->getMessage(),400);
        }


    }

    public function qoptimo(){
        $valor = 0;
        $numeroPedidoEsperado = 0;
        $tiempoEsperaPedidos = 0;
        $demandaDiaria = 0;
        $Ganancia = 0;
        /************************************************************** */
        $Demanda = 1200;
        $SOrdenar = 20;
        $SOrdenarx = 0;
        $valorCostoMantener = 0.3;
        $valorCostoMantenerx = 0;
        $diasPeriodo = 240;
        $total = 0;

        if ($Demanda > 0) {
            $DemandaOptima = sqrt((2 * $Demanda * $SOrdenar) / $valorCostoMantener);
            $numeroPedidoEsperado = $Demanda / $DemandaOptima;

            $tiempoEsperaPedidos = $diasPeriodo / $numeroPedidoEsperado;
            $demandaDiaria = ($Demanda / $diasPeriodo) * $tiempoEsperaPedidos;
            $SOrdenarx = ($Demanda / $DemandaOptima) * $SOrdenar;
            $valorCostoMantenerx = ($DemandaOptima * $valorCostoMantener) / 2;
            $total = ($Demanda * $SOrdenarx) + $SOrdenarx + $valorCostoMantenerx;

            dd([
                'Q' => $DemandaOptima,
                'N' => $numeroPedidoEsperado,
                'L' => $tiempoEsperaPedidos,
                'R' => $demandaDiaria,
                'CO' => $SOrdenarx,
                'CM' => $valorCostoMantenerx,
                'CT' => $total
            ]);
        }
    }
}
