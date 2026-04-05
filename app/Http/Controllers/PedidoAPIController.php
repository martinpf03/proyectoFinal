<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Carrito;
use Illuminate\Http\Request;

class PedidoAPIController extends Controller
{
    public function index($id)
    {
        $pedidos = Pedido::where('usuario_id', $id)->get();
        return response()->json($pedidos);
    }

    public function show($id)
    {
        $pedido = Pedido::find($id);
        if (!$pedido) {
            return response()->json(['error' => 'Pedido no encontrado'], 404);
        }
        
        $productos = $pedido->productos()->get();
        return response()->json(['pedido' => $pedido,'productos' => $productos]);
    }

    public function store(Request $request,$id)
    {
        $carrito = Carrito::where('usuario_id', $id)->first();
        if (!$carrito) {
            return response()->json(['error' => 'Carrito no encontrado'], 404);
        }
        
        $productos = $carrito->productos;
        $pedido = Pedido::create([
            'usuario_id' => $id,
            'metodoPago' => $request->metodoPago,
            'fechaPedido' => now()
        ]);

        foreach ($productos as $producto) {
            $pedido->productos()->attach($producto->id, [
                'cantidad' => $producto->pivot->cantidad,
                'precioVenta' => $producto->precio * $producto->pivot->cantidad,
                'IVA_venta' => 21
            ]);
        }

        foreach ($productos as $producto) {
            $carrito->productos()->detach($producto->id);
        }

        return response()->json(['message' => 'Pedido realizado correctamente', 'pedido' => $pedido]);
    }
}
