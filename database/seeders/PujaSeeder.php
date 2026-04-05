<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Puja;
use Ramsey\Uuid\Type\Time;

class PujaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        for($i=1; $i<=5; $i++){
            $puja = new Puja();
            $puja->usuario_id = rand(1, 5);
            $puja->subasta_id = rand(1, 5);
            $puja->cantidad = rand(1, 10);
            $puja->hora = now();
            $puja->save();
        }
    }
}
