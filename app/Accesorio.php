<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accesorio extends Model
{
    protected $fillable = [
        'num_parte',
        'num_factura',
        'costo_before_iva',
        'num_pedido',
        'cod_interno',
        'orden_compra',
        'cantidad',
        'fecha_recibido',
        'user_id',
        'service_id',
        'repuesto_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public static function getRepuesto($key)
    {
        $repuesto = Repuesto::findOrFail($key);
        return $repuesto;
    }
}
