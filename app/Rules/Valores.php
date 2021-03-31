<?php

namespace App\Rules;

use App\Razon;
use Illuminate\Contracts\Validation\Rule;

class Valores implements Rule
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
    public function passes($attribute, $value)
    {
        if (request()->get('fecha_finalizado') != null) {

            $razon = Razon::find(request()->get('razon_id'), ['nombre']);

            if (!preg_match("/no acepta/i", $razon->nombre)) {

                if (request()->get('valor_aprobado') != request()->get('valor_cotizado')) {
                    return false;
                }
            }
            return true;
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
        return 'Valor Aprobado y Cotizado no son iguales.';
    }
}
