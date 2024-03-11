<?php

namespace App\Filters;
use Illuminate\Http\Request;

class ApiFilter{
    protected $safeParams =[]; //parametro para filtrar modelos
    protected $columnMap =[];  //mapear columnas
    protected $operatorMap =[];  //crea mapeo de operadores
}