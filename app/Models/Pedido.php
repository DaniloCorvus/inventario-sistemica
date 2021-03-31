<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $fillable = [
        'proveedor_id',
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
        'ubicacion',
        'observacion',
        'estado',
    ];
}
