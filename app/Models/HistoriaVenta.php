<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoriaVenta extends Model
{
    protected $table = 'historias_ventas';
    protected $fillable = [
        'fecha_registro',
        'descripcion',
        'user_id',
        'venta_id'
       
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function venta()
    {
        return $this->belongsTo(Venta::class);
    }
}
