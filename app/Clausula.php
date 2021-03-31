<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clausula extends Model
{
    protected $fillable = ['marca_id', 'nombre', 'descripcion'];

    public function marca()
    {
        return $this->belongsTo(Marca::class);
    }
}
