<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//TODO Cambiar tabla  de este modelo 

class Reparacion extends Model
{
    protected $fillable = ['nombre', 'descripcion'];
    // protected $table = 'tipo_reparacions';
}
