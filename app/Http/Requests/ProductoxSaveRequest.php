<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductoxSaveRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // 'proveedor_id' => 'required',
            // 'pedido_id' => 'required',
            // 'cellar_id' => 'required',
         //   'serie' => 'required',
            'modelo' => 'required',
          //  'num_pedido' => 'required',
            'descripcion' => 'required',
            // 'num_factura' => 'required',
            // 'fecha_compra' => 'required',
            // 'fecha_recibido' => 'required',
            // 'fecha_solicitud' => 'required',
          //  'guia' => 'required',
            // 'orden_compra' => 'required',
             'cod_interno' => 'required|unique:productox',
            // 'delivery_orden' => 'required',
            // 'confirmacion' => 'required',
             'num_parte' => 'required',
            // 'costo_in' => 'required',
            // 'costo_antes_iva' => 'required',
            // 'costo_promosion' => 'required',
            // 'costo_venta' => 'required',
            // 'impuesto' => 'required',
            // 'cantidad' => 'required',
            // 'costo_total' => 'required',
            // 'cant_disponible' => 'required',
            // 'ubicacion' => 'required',
            // 'observacion' => 'required',
            // 'estado' => 'required',
            'codigo' => 'required|unique:productox',
        ];
    }
}
