<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    protected $fillable = ['nombre', 'descripcion'];

    public function equipos()
    {
        return $this->hasMany(Equipo::class);
    }
}
