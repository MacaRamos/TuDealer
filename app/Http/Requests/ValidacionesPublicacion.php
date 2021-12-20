<?php

namespace App\Http\Requests;

use App\Rules\ValidarIndicaSativaRuderalis;
use App\Rules\ValidarTHC_CBD;
use Illuminate\Foundation\Http\FormRequest;

class ValidacionesPublicacion extends FormRequest
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
            'titulo' => 'required|max:100',
            'nombre_semilla' => 'required|max:100',
            'tipo_semilla_id' => 'required|exists:tipo_semillas,tipo_semilla_id',
            'descripcion' => 'required',
            'porcentaje_THC' => 'required|between:1,69.9',
            'porcentaje_CBD' => ['required', 'between:1,69.9', new ValidarTHC_CBD($this->get('porcentaje_THC'))],
            'porcentaje_indica' => 'required|between:1,99.9',
            'porcentaje_sativa' => 'required|between:1,99.9',
            'porcentaje_ruderalis' => ['required', 'between:1,99.9', new ValidarIndicaSativaRuderalis($this->get('porcentaje_indica'), $this->get('porcentaje_sativa'))],
            'tiempo_floracion' => 'required',
            'produccion_interior' => 'required',
            'produccion_exterior' => 'required',
            'altura' => 'nullable',
            'semillas_paquete' => 'required',
            'precio' => 'required',
            'stock' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'titulo' => 'título',
            'nombre_semilla' => 'nombre semilla',
            'tipo_semilla_id' => 'tipo semilla',
            'descripcion' => 'descripción',
            'porcentaje_THC' => 'porcentaje THC',
            'porcentaje_CBD' => 'porcentaje CBD',
            'porcentaje_indica' => 'porcentaje indica',
            'porcentaje_sativa' => 'porcentaje sativa',
            'porcentaje_ruderalis' => 'porcentaje ruderalis', 
            'tiempo_floracion' => 'tiempo floración',
            'produccion_interior' => 'producción interior',
            'produccion_exterior' => 'producción exterior',
            'semillas_paquete' => 'semillas x paquete'
        ];
    }
}
