<?php

namespace App\Services;

use App\Service;

class CargueInventarioService
{
    public function castFloats($valor)
    {   try{

        $valor = str_replace(".", "", $valor);
        $valor = str_replace(",", ".", $valor);

        return  $valor;

        } catch (\Throwable $th) {
            return json_encode($th->getMessage());
        }
    }
}
