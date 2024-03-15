<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\FacturaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix'=>'v1','namespace'=>'App\Http\Controllers'], function () {
    Route::apiResource('clientes',ClienteController::class);
    //pueba en el navegador así: http://laravel-api-rest-ful.test/api/v1/clientes
    Route::apiResource('facturas',FacturaController::class);
    Route::post('facturas/agranel', 'FacturaController@aGranelStore');
  

});


