<?php

namespace Database\Seeders;

use App\Models\Cliente;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cliente::factory()
           ->count(25)
           ->hasFacturas(10) //la relacion
           ->create();
           Cliente::factory()
           ->count(100)
           ->hasFacturas(3) //la relacion
           ->create();
           Cliente::factory()
           ->count(100)
           ->hasFacturas(1) //la relacion
           ->create();
           Cliente::factory()
           ->count(5)
           ->create();
    }
}
