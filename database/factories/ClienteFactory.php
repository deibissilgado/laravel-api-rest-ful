<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cliente>
 */
class ClienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {       //tipo una empresa o una persona independiente
            $tipo = $this->faker->randomElement(['I','E']);
            $name = $tipo == 'I' ? $this->faker->name() : $this->faker->company();
        
            return [
            'name'=>$name,
            'tipo'=>$tipo,
            'email'=> $this->faker->email(),
            'direccion'=> $this->faker->streetAddress(),
            'ciudad'=> $this->faker->city(),
            'departamento'=> $this->faker->state(),
            'codigo_postal'=> $this->faker->postcode(),
        ];
    }
}
