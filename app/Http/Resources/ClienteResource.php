<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClienteResource extends JsonResource
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
            'name'=> $this->name ,
            'tipo'=> $this->tipo ,
            'email'=> $this->email ,
            'direccion'=> $this->direccion ,
            'ciudad'=> $this->ciudad ,
            'departamento'=> $this->departamento ,
            'codigoPostal'=> $this->codigo_postal,
        ];
    }
}
