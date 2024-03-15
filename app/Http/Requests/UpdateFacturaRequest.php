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
            //metodo PATCH , no requiere todos los parametros
            return [
                'cantidad'=> 'required|numeric' ,
                'estado'=> 'required|in:p,P,v,V,f,F',
                'fechaFacturada' => 'required|date_format:Y-m-d H:i:s',
                'fechaPagada' => 'date_format:Y-m-d H:i:s|nullable',
            ];
        }
    }
}
