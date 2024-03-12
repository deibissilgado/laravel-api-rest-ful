<?php

namespace App\Filters;
use Illuminate\Http\Request;
use App\Filters\ApiFilter;

//Extendiendo de ApiFilter
class ClienteFilter extends ApiFilter{

    protected $safeParams =[
        'name'=> ['eq'],
        'tipo'=> ['eq'],
        'email'=> ['eq'],
        'direccion'=> ['eq'],
        'ciudad'=> ['eq'],
        'departamento'=> ['eq'],
        'codigo_postal'=> ['eq','gt','lt'],
    ]; //parametro fijos filtrar modelos
    protected $columnMap =[
        'codigo_postal'=> 'codigoPostal',
    ];  //mapear columnas 
    protected $operatorMap =[
        'eq' => '=', //defino el significado de eq
        'gt' => '>', //defino el significado de gt
        'gte' => '>=', //defino el significado de gte
        'lt' => '<', //defino el significado de lt
        'lte' => '<=', //defino el significado de lte        
    ];  //crea mapeo de operadores


}