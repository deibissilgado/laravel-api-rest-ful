<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFacturaRequest extends FormRequest
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
        return [
            'clienteId'=> 'required|integer' ,
            'cantidad'=> 'required|numeric' ,
            'estado'=> 'required|in:p,P,v,V,f,F',
            'fechaFacturada' => 'required|date_format:Y-m-d H:i:s',
            'fechaPagada' => 'date_format:Y-m-d H:i:s|nullable',
        ];
    }

          /*El método prepareForValidation es un método utilizado en las clases de 
    solicitudes (Request) en Laravel. Este método te permite manipular los 
    datos de la solicitud antes de que se realice la validación de los mismos. */
    protected function prepareForValidation(){
        $this->merge([
            'cliente_id' => $this->clienteId,
            'fecha_facturada' => $this->fechaFacturada,
            'fecha_pagada' => $this->fechaPagada,
        ]);
    }
    
}
