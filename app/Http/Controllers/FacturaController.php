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
        //
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
     * Display the specified resource.
     */
    public function show(Factura $factura)
    {        
       // Verificar si el parámetro cliente está presente en la solicitud
        if (request()->has('cliente')){
           
            return new FacturaResource($factura->load('cliente'));
            /*loadMissing es un método utilizado para cargar relaciones ausentes 
            de un modelo sin sobrecargar las relaciones que ya han sido cargadas 
            previamente. Esto es útil cuando tienes un modelo que ya ha sido recuperado 
            de la base de datos y deseas cargar una relación que aún no ha sido cargada 
            sin volver a cargar todas las relaciones que ya han sido cargadas previamente.*/
        }
     return new FacturaResource($factura);
   /*Ejemplo de peticion
   http://laravel-api-rest-ful.test/api/v1/facturas/14 
   http://laravel-api-rest-ful.test/api/v1/facturas/14?cliente=true */
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Factura $factura)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFacturaRequest $request, Factura $factura)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Factura $factura)
    {
        //
    }
}
