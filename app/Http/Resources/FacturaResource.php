<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FacturaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'id'=> $this->id ,
            'cliente_id'=> $this->cliente_id ,
            'cantidad'=> $this->cantidad ,
            'estado'=> $this->estado ,
            'fechaFacturada'=> $this->fecha_facturada ,
            'fechaPagada'=> $this->fecha_pagada ,
        ];
    }
}
