<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use App\Http\Requests\StoreFacturaRequest;
use App\Http\Requests\UpdateFacturaRequest;
use App\Http\Resources\FacturaCollection;
use Illuminate\Http\Request;
use App\Filters\FacturaFilter;
use App\Http\Requests\AGranelStoreFacturaRequest;
use App\Http\Resources\FacturaResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Arr;

class FacturaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filtro = new FacturaFilter;
        $queryItems = $filtro->transform($request);
        if (count($queryItems) == 0) {
            return new FacturaCollection(Factura::paginate());
        } else {
            $facturas = Factura::where($queryItems);
            return new FacturaCollection($facturas->paginate()->appends($request->query()));
        }
        /*Ejemplo de solicitud 
         http://laravel-api-rest-ful.test/api/v1/facturas?estado[eq]=p */    

        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFacturaRequest $request)
    {
       /* Puedes hacerlo así:
           // Obtener los datos validados del request
            $data = $request->validated();

            // Insertar los datos en la tabla 'facturas'
            Factura::insert([
                'cliente_id' => $data['clienteId'],
                'cantidad' => $data['cantidad'],
                'estado' => $data['estado'],
                'fecha_facturada' => $data['fechaFacturada'],
                'fecha_pagada' => $data['fechaPagada'],
            ]);
        ó así:
       */
        return new FacturaResource(Factura::create($request->all()));
    }

    public function aGranelStore(AGranelStoreFacturaRequest $request){

      $aGreanel = collect($request->all())->map( function($array,$key){
        
                    return Arr::except($array,['clienteId',
                                                'fechaFacturada',
                                                'fechaPagada',
                                                ]);
               });

     Factura::insert($aGreanel->toArray());

    }
    /**
     * Muestra el recurso especificado.
     */
    public function show($factura)
    {     
        /* Evito la inyeccion de dependencia show(Factura $factura) para
        personalizar el mensaje de error */  
       $factura = Factura::find($factura);

        if (!$factura) {
            return response()->json(['message' => 'No existe la factura'], 404);
        }

       // Verificar si el parámetro cliente está presente en la solicitud
        if (request()->has('cliente')){
           
            return new FacturaResource($factura->load('cliente'));
        }
       return new FacturaResource($factura);
        /*Ejemplo de peticion
        http://laravel-api-rest-ful.test/api/v1/facturas/14 
        http://laravel-api-rest-ful.test/api/v1/facturas/14?cliente */
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UpdateFacturaRequest $request, Factura $factura)
    {
        // $factura->update($request->all());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFacturaRequest $request, Factura $factura)
    {
        $factura->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($factura)
    {
       $barrada = Factura::find($factura);

       if (!$barrada) {
            return response()->json([
                'success' => false,
                'message' => 'Factura no existe'
            ],404);
        }

        $factura->delete();

        return response()->json([
            'success' => true,
            'message' => 'Factura eliminada correctamente'
        ],200);
 
    }
}
