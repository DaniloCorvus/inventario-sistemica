<?php

namespace App;

//use App\Models\CargueInventario;
use Illuminate\Database\Eloquent\Model;

class Productox extends Model
{
    //
    protected $table = 'productox';
    protected $primaryKey = 'id';

    static function validarProducto($codigo){
        return Productox::where('codigo', '=', $codigo )->exists() ? true : false;
    }
   
}
