<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
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
        'opcional_telefono',
        'departamento',
        'date_last',
        'last',
        'accept'
    ];

    public function equipos()
    {
        return $this->hasMany(Equipo::class);
    }

    protected $appends = ['fullname'];

    public function getFullnameAttribute()
    {
        return $this->attributes['nombre'] . ' ' . $this->attributes['apellido'];
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }
}
