<?php

namespace Database\Seeders;

use App\Models\Pedido;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PedidoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        for($i=1; $i<=5; $i++){
            $pedido = new Pedido();
            $pedido->usuario_id = rand(1, 5);
            $pedido->metodoPago = 'Tarjeta';
            $pedido->fechaPedido = now()->subDays($i);
            $pedido->save();
        }
    }
}
