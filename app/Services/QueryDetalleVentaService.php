<?php

namespace App\Services;

use App\Models\Venta;
use App\Cliente;
use App\User;
use App\HappycallEstado;
use Illuminate\Support\Facades\DB;
class QueryDetalleVentaService
{
    public function query($venta)
    {
        $clientes = Cliente::toBase()->get();
       $users = User::toBase()->get();
       
        $happycallestados = HappycallEstado::toBase()->get();
        //dd($venta);
        $productos = DB::select('
            SELECT I.serie , P.codigo,
            P.cod_interno,
            P.modelo,
            P.num_parte , 
            D.cantidad, D.precio
            FROM detalles D
            INNER JOIN inventario I ON I.id = D.inventario_id 
            INNER JOIN productox P ON P.id = i.productox_id
            WHERE D.venta_id =
        '.$venta->id);
        $totales['subtotal'] = 0;
        foreach ($productos as $key => $value) {
            # code...
            $totales['subtotal']+= $value->cantidad * $value->precio;

        }
        $totales['subtotalImpuesto'] = ( $totales['subtotal'] * $venta->impuesto ) / 100;
        $totales['total'] =   $totales['subtotal'] +    $totales['subtotalImpuesto'];

        if ($venta) {
            return view('inventario.detalleventas.show', compact( 'venta', 'happycallestados','productos', 
           'clientes', 'users', 'totales' ));
        }

       /*  $query = request()->get('query');
        return view('admin.nofound', compact('query')); */
    }


    public function getInfo($id)
    {

        return  Venta::with(
            [
                'cliente' 
                ,
                'empresa',
             
            ]
         
        )->findOrFail($id);

    }
}
