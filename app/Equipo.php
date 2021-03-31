<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    protected $fillable = [
        'cliente_id',
        'num_factura',
        'fecha_compra',
        'marca',
        'v_declarado',
        'modelo',
        'serie',
        'imei_uno',
        'imei_dos',
        'procedencia',
        'garantia',
        'referencia',
        'descripcion',
        'observacion'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function getCompradoAttribute()
    {
        return ($this->attributes['fecha_compra']) ? date('d-m-Y', strtotime($this->attributes['fecha_compra'])) : 'sin fecha';
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'descripcion');
    }

    // TODO arreglar esta vaina de marca

    public function marca()
    {
        return $this->belongsTo(Marca::class, 'marca');
    }

    public function marka()
    {
        return $this->belongsTo(Marca::class, 'marca');
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }
}
