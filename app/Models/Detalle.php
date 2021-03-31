<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalle extends Model
{
    protected $fillable = [
        'inventario_id',
        'venta_id',
        'cantidad',
        'precio',
    ];

    public function inventario(){
        return $this->belongsTo(Inventario::class);
    }
}
