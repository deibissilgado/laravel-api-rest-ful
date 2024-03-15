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
        $data = [
            'id' => $this->id,
            'cliente_id' => $this->cliente_id,
            'cantidad' => $this->cantidad,
            'estado' => $this->estado,
            'fechaFacturada' => $this->fecha_facturada,
            'fechaPagada' => $this->fecha_pagada,
        ];
        // Verificar si el parámetro cliente está presente en la solicitud para cargamos la relacion
        if ($request->has('cliente')) {
            $data['cliente'] = new ClienteResource($this->whenLoaded('cliente'));
        }

        return $data;

    }
}
