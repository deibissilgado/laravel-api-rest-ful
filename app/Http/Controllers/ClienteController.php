<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Http\Requests\StoreClienteRequest;
use App\Http\Requests\UpdateClienteRequest;
use Illuminate\Http\Request;
use App\Http\Resources\ClienteCollection;
use App\Filters\ClienteFilter;
use App\Http\Resources\ClienteResource;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filtro = new ClienteFilter;
        $queryItems = $filtro->transform($request);
      //Si el valor incluirFacturas en la petición, http://laravel-api-rest-ful.test/api/v1/clientes?incluirFacturas=true
        $incluirFacturas = $request->query('incluirFacturas');
        $clientes = Cliente::where($queryItems);
        if ($incluirFacturas) {
            $clientes = $clientes->with('facturas');
        }
        return new ClienteCollection($clientes->paginate()->appends($request->query()));
        /*Ejemplo de uos de filtros filtro 
        http://laravel-api-rest-ful.test/api/v1/clientes?departamento[eq]=Louisiana 
        http://laravel-api-rest-ful.test/api/v1/clientes?tipo[eq]=i&incluirFacturas=true*/
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
    public function store(StoreClienteRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente)
    {
        $incluirFacturas = request()->query('incluirFacturas');

        if ($incluirFacturas) {
            
                 return new ClienteResource($cliente->loadMissing('facturas'));
                 /*loadMissing es un método utilizado para cargar relaciones ausentes 
                 de un modelo sin sobrecargar las relaciones que ya han sido cargadas 
                 previamente. Esto es útil cuando tienes un modelo que ya ha sido recuperado 
                 de la base de datos y deseas cargar una relación que aún no ha sido cargada 
                 sin volver a cargar todas las relaciones que ya han sido cargadas previamente.*/
             }
        return new ClienteResource($cliente);
        /*Ejemplo de peticion
        http://laravel-api-rest-ful.test/api/v1/clientes/1 */
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cliente $cliente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClienteRequest $request, Cliente $cliente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $cliente)
    {
        //
    }
}
