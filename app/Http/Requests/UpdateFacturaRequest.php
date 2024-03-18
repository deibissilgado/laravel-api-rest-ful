<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFacturaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $metodo = $this->method();

        if ($metodo ==='PUT') {

            return [
                'cantidad'=> 'required|numeric' ,
                'estado'=> 'required|in:p,P,v,V,f,F',
                'fechaFacturada' => 'required|date_format:Y-m-d H:i:s',
                'fechaPagada' => 'date_format:Y-m-d H:i:s|nullable',
              ];
            
        }else{
            /*metodo PATCH , no requiere todos los parametros 
            sometimes india que pudiera o no estar presente*/
            return [
                'cantidad'=> 'sometimes|required|numeric' ,
                'estado'=> 'sometimes|required|in:p,P,v,V,f,F',
                'fechaFacturada' => 'sometimes|required|date_format:Y-m-d H:i:s',
                'fechaPagada' => 'sometimes|date_format:Y-m-d H:i:s|nullable',
            ];
        }
    }
          /*El método prepareForValidation es un método utilizado en las clases de 
    solicitudes (Request) en Laravel. Este método te permite manipular los 
    datos de la solicitud antes de que se realice la validación de los mismos. */
    protected function prepareForValidation(){
      /* Los campos fechaFacturada  fechaPagada no están definidos 
      de este modo en la base de datos */
        if ($this->fechaFacturada || $this->fechaPagada) {
            $this->merge([
                'fecha_facturada' => $this->fechaFacturada,
                'fecha_pagada' => $this->fechaPagada,
            ]);
        }
  
    }


}
