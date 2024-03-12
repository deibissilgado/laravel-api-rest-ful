<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreClienteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; //autoriza a todos
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [            
            'name'=> ['required'] ,
            'tipo'=> ['required',Rule::in(['i','I','E','e'])],
            'email'=> ['required','email'],
            'direccion'=> ['required'],
            'ciudad'=> ['required'],
            'departamento'=> ['required'],
            'codigoPostal'=> ['required'],
        ];
    }
    /*El método prepareForValidation es un método utilizado en las clases de 
    solicitudes (Request) en Laravel. Este método te permite manipular los 
    datos de la solicitud antes de que se realice la validación de los mismos. */
    protected function prepareForValidation(){

        $this->merge([
            'codigo_postal' => $this->codigoPostal,
        ]);
    }

 

}
