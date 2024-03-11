<?php

namespace Database\Factories;

use App\Models\Cliente;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Factura>
 */
class FacturaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {   
        //facturado, pagado, vendido
        $estado = $this->faker->randomElement(['F','P','V']);
       
        return [
            'cliente_id' => Cliente::factory(),
            'cantidad' => $this->faker->randomElement([100,20000]),
            'estado' => $estado ,
            'fecha_facturada' => $this->faker->dateTimeThisDecade(),
            'fecha_pagada' => $estado =='P' ? $this->faker->dateTimeThisDecade() : null,
        ];
    }
}
