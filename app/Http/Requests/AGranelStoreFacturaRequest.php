<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AGranelStoreFacturaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; //todos
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        //será un array por lo que anteponemos *
        //estado: facturado, pagado, vendido
        return [
            '*.clienteId'=> 'required|integer' ,
            '*.cantidad'=> 'required|numeric' ,
            '*.estado'=> 'required|in:p,P,v,V,f,F',
            '*.fechaFacturada' => 'required|date_format:Y-m-d H:i:s',
            '*.fechaPagada' => 'date_format:Y-m-d H:i:s|nullable',
        ];
        
    }

      /*El método prepareForValidation es un método utilizado en las clases de 
    solicitudes (Request) en Laravel. Este método te permite manipular los 
    datos de la solicitud antes de que se realice la validación de los mismos. */
    protected function prepareForValidation(){
       $data =[];
       foreach ($this->toArray() as $obj) {
         $obj['cliente_id']=$obj['clienteId'] ?? null ;
         $obj['fecha_facturada']=$obj['fechaFacturada'] ?? null ;
         $obj['fecha_pagada']=$obj['fechaPagada'] ?? null ;
         $data[]=$obj;
       }
        $this->merge($data);
    }

}
