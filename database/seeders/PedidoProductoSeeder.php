<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PedidoProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        for ($i = 1; $i <= 5; $i++) {
            DB::table('pedido_producto')->insert([
                'pedido_id' => rand(1, 5),
                'producto_id' => rand(1, 5),
                'cantidad' => rand(1, 3),
                'precioVenta' => rand(10, 500),
                'IVA_venta' => rand(1, 21)
            ]);
        }
    }
}
