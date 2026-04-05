<?php

namespace Database\Seeders;

use App\Models\Producto;
use App\Models\Pieza;
use App\Models\Consola;
use App\Models\Arcade;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $tipos = [
            'pieza',
            'pieza',
            'consola',
            'consola',
            'arcade'
        ];

        for($i=1; $i<=5; $i++){
            $producto = new Producto();
            $producto->nombre = 'Producto'.$i;
            $producto->url_imagen = 'media/img/arcade.png';
            $producto->descripcion = 'Descripcion del producto '.$i;
            $producto->stock = rand(1, 100);
            $producto->precio = rand(10, 500);
            $producto->IVA = 0.21;
            $producto->tipo = $tipos[$i-1];
            $producto->vendedor_id = rand(1, 5);
            $producto->save();
        }
        for($i=0;$i<2;$i++){
            $pieza = new Pieza();
            $pieza -> dimensiones = "200x200mm";
            $pieza -> peso = 20.00;
            $pieza -> garantia = 2;
            $pieza -> producto_id = $i+1;
            $pieza -> save();
        }
        for($i=0;$i<2;$i++){
            $consola = new Consola();
            $consola -> marca = "Nintendo";
            $consola -> portatil = true;
            $consola -> producto_id = $i+3;
            $consola -> save();
        }

        $arcade = new Arcade();
        $arcade -> anho_salida = 1985;
        $arcade -> marca = 'Atari';
        $arcade -> producto_id = 5;
        $arcade -> save();

       
    }
}
