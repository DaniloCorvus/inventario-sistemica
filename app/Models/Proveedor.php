<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{

    protected $fillable = [
        'nombres',
        // 'apellidos',
        'sexo',
        'email',
        'tipo_identificacion',
        'identificacion',
        'tipo_casa',
        'ciudad',
        'barrio',
        'direccion',
        'telefono',
        'telefono_opcional',
        'departamento',
        'estado'
    ];

    /**
     * Get members full name
     * 
     * @return string
     */
    public function getFullnameAttribute()
    {
        return $this->attributes['nombres'];
    }
}
