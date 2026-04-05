<?php

namespace Database\Seeders;

use App\Models\Carrito;
use Illuminate\Database\Seeder;

class CarritoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        for($i=1; $i<=5; $i++){
            $carrito = new Carrito();
            $carrito->usuario_id = $i;
            $carrito->save();
        }
    }
}
