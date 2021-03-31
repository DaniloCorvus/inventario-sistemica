<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CargueInventario extends Model
{
    //
    protected $table = 'cargues_inventario';
    protected $primaryKey = 'id';

   protected $fillable =   ["proveedor_id",
                                "estado" ,
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
                                "observacion",
                                "inventario_id"
                                ];
}
