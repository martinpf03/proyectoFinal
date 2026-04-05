<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Subasta;
use Illuminate\Support\Facades\DB;

class ProcesarSubastas extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:procesar-subastas';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
public function handle()
{
    $subastas = Subasta::where('fechaFin', '<=', now())->get();

    foreach ($subastas as $subasta) {

        $pujaMax = $subasta->pujas()->orderByDesc('cantidad')->first();

        if ($pujaMax) {

            $usuario = $pujaMax->user;
            $productoSub = $subasta->producto;

            $carrito = $usuario->carrito ?? $usuario->carrito()->create([]);

            $productoExistente = $carrito->productos()
                ->where('producto_id', $productoSub->id)
                ->wherePivot('precio_carrito', $pujaMax->cantidad)
                ->first();

            if ($productoExistente) {

                $carrito->productos()
                    ->where('producto_id', $productoSub->id)
                    ->wherePivot('precio_carrito', $pujaMax->cantidad)
                    ->update([
                        'cantidad' => DB::raw('cantidad + 1')
                    ]);

            } else {

                $carrito->productos()->attach([
                    $productoSub->id => [
                        'cantidad' => 1,
                        'precio_carrito' => $pujaMax->cantidad
                    ]
                ]);
            }

            $productoSub->bajarStock(1);

            $subasta->delete();
        }
    }
}
}

