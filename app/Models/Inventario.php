<?php

namespace App\Models;

use App\Productox;
use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    //
    protected $table = 'inventario';
  
    protected $fillable = ['productox_id' ,
    'serie' ,
    'cantidad' ,
    'cellar_id' ];

    public function Cargues(){
        return $this->hasMany(CargueInventario::class,'inventario_id','id');
    }

    public function producto(){
        return $this->hasOne(Productox::class,'id','productox_id');
    }
}
