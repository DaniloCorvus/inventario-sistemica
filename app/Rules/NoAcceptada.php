<?php

namespace App\Rules;

use App\Estado;
use App\Modo;
use App\Razon;
use App\Reparacion;
use GuzzleHttp\Psr7\Request;
use Illuminate\Contracts\Validation\Rule;

class NoAcceptada implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $fecha)
    {
        if ($fecha != null) {

            $tipo = Reparacion::find(request()->get('tipo_reparacion'), ['nombre']);
            $modo = Modo::find(request()->get('modo_id'), ['nombre']);
            $estado = Estado::find(request()->get('estado_id'), ['nombre']);
            $razon = Razon::find(request()->get('razon_id'), ['nombre']);

            $validaciones = [request()->get('reporte'), request()->get('valor_obra'), request()->get('valor_aprobado'), request()->get('valor_cotizado')];
            $validacionesNombres = [$tipo->nombre, $razon->nombre, $estado->nombre];
            $validacionesEstado = ['reparacion pendiente',];

            foreach ($validaciones as $req) {
                if ($req == null) {
                    return false;
                }
            }

            foreach ($validacionesNombres as $req) {
                if ($req == 'Reparacion Aceptada') {
                    return false;
                }
            }
            foreach ($validacionesEstado as $req) {
                if (preg_match("/$req/i", $estado->nombre)) {
                    return false;
                }
            }

            if (!preg_match("/reparacion terminada/i", $razon->nombre)) {
                if (!preg_match("/reparacion cancelada/i", $razon->nombre)) {
                    if (!preg_match("/venta terminada/i", $razon->nombre)) {
                        if (!preg_match("/no acepta/i", $razon->nombre)) {
                            return false;
                        }
                    }
                }
            }

            if (!preg_match("/no acepta/i", $razon->nombre)) {
                if (!preg_match("/In Warranty/i", $modo->nombre)) {
                    if (!preg_match("/Extended warranty/i", $modo->nombre)) {
                        if (request()->get('fecha_promesa') == null) {
                            return false;
                        }
                        if (request()->get('fecha_autorizado') == null) {
                            return false;
                        }
                    }
                }
            }
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ' Para guardar este servicio con exito por favor verifique. </br> * El Tipo de reparaci¨®n, Estado, y Razon, deben ser diferentes a Reparacion aceptada </br> * El estado debe ser diferente a Reparacion pendiente </br> * La razon debe ser Reparacion Terminada, Reparacion Cancelada o Venta terminada </br> * Valor Mano de Obra, Valor Aprobado, Valor cotizado, no pueden estar vacios </br> * Debe asignar fecha promesa y fecha de autorizado (si NO es garantia)  </br> * Llene Reporte Tecnico';
    }
}
