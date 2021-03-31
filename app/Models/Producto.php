<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Milon\Barcode\DNS1D;

class Producto extends Model
{

    protected $table = 'productox';

    protected $fillable = [
        'proveedor_id',
        'pedido_id',
        'cellar_id',
        'serie',
        'modelo',
        'num_pedido',
        'descripcion',
        'num_factura',
        'fecha_compra',
        'fecha_recibido',
        'fecha_solicitud',
        'guia',
        'orden_compra',
        'cod_interno',
        'delivery_orden',
        'confirmacion',
        'num_parte',
        'costo_in',
        'costo_antes_iva',
        'costo_promosion',
        'costo_venta',
        'impuesto',
        'cantidad',
        'costo_total',
        'cant_disponible',
        'ubicacion',
        'observacion',
        'estado',
        'codigo',
    ];

    public function getCodigoAttribute()
    {
        $barra = new DNS1D();
        return    $barra->getBarcodePNG($this->attributes['codigo'], 'C39', 3, 33, array(1, 1, 1), true);
    }

    protected $appends = ['optimo'];

    public function getOptimoAttribute()
    {

// La demanda (D) es de 1200 unidades por año.
// El costo de ordenar (S) es 20 por orden.
// El costo anual de mantener (H) por unidad es 0,3 por unidad.
// Días de trabajo al año: 240 días.

       $nombre= 0;
       $descripcion= 0;
       $cantidad= 0;
        $valor= 0;
        $costo= 0;
        $cantidadOptima= 0;
        $numeroPedidoEsperado= 0;
        $tiempoEsperaPedidos= 0;
        $demandaDiaria= 0;
        $Ganancia= 0;
        /************************************************************** */
        $Demanda = 1200 ;
        $SOrdenar = 20 ;
        $valorCostoMantener= 0.3;
        $diasPeriodo= 240;
        
        if ($Demanda > 0 ) {
            $DemandaOptima = sqrt((2*$Demanda * $SOrdenar/ $valorCostoMantener));
            $numeroPedidoEsperado =$Demanda/$DemandaOptima;
            $tiempoEsperaPedidos = $diasPeriodo/$numeroPedidoEsperado;
            $demandaDiaria = $Demanda/$diasPeriodo;
            $ganancia = ($valor * $Demanda) - ($SOrdenar*$Demanda);
        }

    }
}
