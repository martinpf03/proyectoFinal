<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this -> call(
            [
                UserSeeder::class,
                CarritoSeeder::class,
                ProductoSeeder::class,
                SubastaSeeder::class,
                PedidoSeeder::class,
                PujaSeeder::class,
                CarritoProductoSeeder::class,
                PedidoProductoSeeder::class
            ]
            );
        
    }
}
