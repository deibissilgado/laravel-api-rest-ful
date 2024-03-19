<?php

namespace App\Filters;
use Illuminate\Http\Request;

class ApiFilter {

   /* $safeParams. parametro para filtrar modelos. defines los parámetros que se pueden usar 
    para filtrar los modelos y los operadores que se pueden aplicar a esos parámetros. */
    protected $safeParams =[]; 

    /* $columnMap. Mapea los nombres de columna que puedes usar en tus parámetros 
    a los nombres de columna reales en tu base de datos. Esto es útil si los 
    nombres de columna en tu base de datos son diferentes de los que deseas 
    exponer en la API. */
    protected $columnMap =[]; 

    /*$operatorMap Mapea los operadores que se pueden usar en los parámetros 
    a los operadores reales en la consulta SQL */
    protected $operatorMap =[];  //crea mapeo de operadores

    /* El método transform(Request $request) que toma una solicitud HTTP y la transforma
     en un formato que puede ser utilizado para filtrar modelos en la base de datos. */
    public function transform(Request $request){

        $eloQuery =[]; //vacia
        // recorre los parámetros de solicitud permitidos ($safeParams)
        /* Eje: http://laravel-api-rest-ful.test/api/v1/clientes?ciudad[eq]=Fisherside
        $parm = ciudad y  $operators = eq  */

        foreach ($this->safeParams as $parm => $operators) {
           //verifica si están presentes en la solicitud 
            $query = $request->query($parm);

            if (!isset($query)) {
                continue;
            } 
           
            $column = $this->columnMap[$parm] ?? $parm;

            foreach ($operators as  $operator) {

               if (isset($query[$operator])) {
                //construye un array que puede ser usado para aplicar los filtros en la consulta SQL.
                $eloQuery[]=[$column,$this->operatorMap[$operator],$query[$operator]];
               }
               
            }           
           
        }

        return $eloQuery;
    }

}