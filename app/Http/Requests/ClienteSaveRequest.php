<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteSaveRequest extends FormRequest
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

            'nombre' => 'required',
            'tipo_identificacion' => 'required',
            'identificacion' => 'required|unique:clientes,identificacion',
            'ciudad' => 'required',
            'departamento' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
            'apellido' => 'required_if:tipo_identificacion,Cedula,Pasaporte'

        ];
    }

    public function messages()
    {
        return [

            'identificacion.digits_between' => 'El numero de identificacion debe contener entre 1 y 10 numeros',
            'identificacion.unique' => 'El numero de identificacion ya se encuentra registrado',
        ];
    }
}
