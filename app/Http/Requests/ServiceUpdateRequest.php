<?php

namespace App\Http\Requests;

use App\Rules\NoAcceptada;
use App\Rules\Valores;
use Illuminate\Foundation\Http\FormRequest;

class ServiceUpdateRequest extends FormRequest
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
    // TODO service update
    public function rules()
    {
        return [
            'fecha_finalizado' => [new NoAcceptada],
            'valor_aprobado' => [new Valores]
        ];
    }
}
