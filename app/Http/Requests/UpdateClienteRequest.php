<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClienteRequest extends FormRequest
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
        $metodo = $this->method();

        if ($metodo ==='PUT') {

            return [
                'name'=> 'required' ,
                'tipo'=> 'required|in:i,I,E,e',
                'email'=> 'required|email',
                'direccion'=> 'required',
                'ciudad'=> 'required',
                'departamento'=> 'required',
                'codigoPostal'=> 'required',
            ];
            
        }else{
            //metodo PATCH
            return [
                'name'=> 'sometimes|required' ,
                'tipo'=> 'sometimes|required|in:i,I,E,e',
                'email'=> 'sometimes|required|email',
                'direccion'=> 'sometimes|required',
                'ciudad'=> 'sometimes|required',
                'departamento'=> 'sometimes|required',
                'codigoPostal'=> 'sometimes|required',
            ];
        }
 
    }

       /*El método prepareForValidation es un método utilizado en las clases de 
    solicitudes (Request) en Laravel. Este método te permite manipular los 
    datos de la solicitud antes de que se realice la validación de los mismos. */
    protected function prepareForValidation(){

        if ($this->codigoPostal) {
            $this->merge([
                'codigo_postal' => $this->codigoPostal,
            ]);
        }
  
    }
}
