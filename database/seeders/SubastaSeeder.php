<?php

namespace Database\Seeders;

use App\Models\Subasta;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubastaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        for($i=1; $i<=5; $i++){
            $subasta = new Subasta();
            $subasta->producto_id = rand(1, 5);
            $subasta->pInicial = rand(50, 200);
            $subasta->pFinal = null;
            $subasta->fechaInicio = now()->subDays($i);
            $subasta->fechaFin = now()->addDays($i);
            $subasta->save();
        }
    }
}
