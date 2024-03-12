<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class FacturaCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {   /*se utiliza para transformar una colección de recursos
        en un formato específico para su presentación en una respuesta HTTP, 
        generalmente en formato JSON. */
        return parent::toArray($request);
    }
}
