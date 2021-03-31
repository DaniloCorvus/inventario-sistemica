<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    
    protected $fillable = [
        'nombre',
        'apellido',
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
        'departamento'
    ];

    /**
     * Get client full name
     *
     * @return string
     */
    protected $appends = ['fullname'];

    public function getFullnameAttribute()
    {
        return $this->attributes['nombre'] . ' ' . $this->attributes['apellido'];
    }
}
