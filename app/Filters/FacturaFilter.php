<?php

namespace App\Filters;
use Illuminate\Http\Request;
use App\Filters\ApiFilter;

//Extendiendo de ApiFilter
class FacturaFilter extends ApiFilter{

    protected $safeParams =[
        'cliente_id'=> ['eq'],
        'cantidad'=> ['eq','gt','gte','lt','lte'],
        'estado'=> ['eq','ne'],
        'fecha_facturada'=> ['eq','gt','gte','lt','lte'],
        'fecha_pagada'=> ['eq','gt','gte','lt','lte'],
    ]; //parametro fijos filtrar modelos
    protected $columnMap =[
        'cliente_id'=> 'clienteId',
        'fecha_facturada'=> 'fechaFacturada',
        'fecha_pagada'=> 'fechaPagada',
    ];  //mapear columnas 
    protected $operatorMap =[
        'eq' => '=', //defino el significado de eq (equal)
        'gt' => '>', //defino el significado de gt (greater than)
        'gte' => '>=', //defino el significado de gte (greater than or equal)
        'lt' => '<', //defino el significado de lt (Less than)
        'lte' => '<=', //defino el significado de lte  (Less than or equal) 
        'ne' => '!=', //defino el significado de ne  (Not equal)     
    ];  //crea mapeo de operadores


}