<?php

namespace App\Filters;
use Illuminate\Http\Request;

class ApiFilter{
    protected $safeParams =[]; //parametro para filtrar modelos
    protected $columnMap =[];  //mapear columnas 
    protected $operatorMap =[];  //crea mapeo de operadores

    //transformando la Query recibida
    public function transform(Request $request){
        $eloQuery =[]; //vacia
        
        foreach ($this->safeParams as $parm => $operators) {
            $query = $request->query($parm);

            if (!isset($query)) {
                continue;
            } 
            $column = $this->columnMap[$parm];
            
        }
    }
}