<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Repuesto extends Model
{
    protected $fillable = [
        'service_id',
        'proveedor_id',
        'serie',
        'modelo',
        'num_pedido',
        'descripcion',
        'num_factura',
        'fecha_compra',
        'fecha_solicitud',
        'fecha_recibido',
        'guia',
        'orden_compra',
        'cod_interno',
        'delivery_orden',
        'confirmacion',
        'num_parte',
        'valor_before_iva',
        'impuesto',
        'costo_in',
        'costo_total',
        'costo_in',
        'costo_venta',
        'cantidad',
        'cant_disponible',
        'ubicacion',
        'observacion',
        'estado'
    ];


    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }


    public function services()
    {
        return $this->belongsToMany(Service::class);
    }

    public function accesorios()
    {
        return $this->hasMany(Accesorio::class);
    }
}
