<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cellar extends Model
{
    protected $fillable = [
        'nombre',
        'direccion',
        'estado'
    ];

    public function productos()
    {
        return $this->hasMany(Producto::class);
    }
}
