<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidacionesCompra extends FormRequest
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
            'unidades' => 'required|integer',
            'region_id' => 'required|exists:regiones,region_id',
            'comuna_id' => 'required|exists:comunas,comuna_id',
            'nombre_recibe' => 'required|string|max:255',
            'RUT_recibe' => 'required|string|max:12',
            'celular_recibe' => 'required|string|max:15',
            'email_recibe' => 'required|string|email|max:255',
            'calle' => 'required|string',
            'numero_direccion' => 'required|integer',
            'numero_departamento' => 'nullable|integer'
        ];
    }
}
