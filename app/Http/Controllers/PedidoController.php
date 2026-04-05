<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Carrito;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PedidoController extends Controller
{
    public function index()
    {
        if (Auth::user()->role == "admin")
            $pedidos = Pedido::all();
        else
            $pedidos = Pedido::where('usuario_id', Auth::id())->get();

        return view('pedidos.index', ['pedidos' => $pedidos]);
    }

    public function show()
    {
        $carrito  = Carrito::where('usuario_id', Auth::id())->first();
        $productos = $carrito->productos()->get();

        return view('pedidos.show', ['productos' => $productos]);
    }

    public function store(Request $request)
    {
        // Obtener el carrito del usuario autenticado
        $carrito  = Carrito::where('usuario_id', Auth::id())->first();
        $productos = $carrito->productos; // Acceder a los productos del carrito
        $total = 0;


        if ($productos->count() > 0) {

            if ($request->metodoPago === 'paypal') {
                foreach ($productos as $producto) {
                    $total += $producto->precio * $producto->pivot->cantidad;
                }

                return redirect()->route('paypal.create', [
                    'total' => $total,

                ]);
            } else if($request->metodoPago === 'tarjeta'){
                // Crear un nuevo pedido
                $pedido = Pedido::create([
                    'usuario_id' => Auth::id(),
                    'metodoPago' => $request->metodoPago,
                    'fechaPedido' => now()
                ]);

                // Iterar sobre los productos del carrito
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
            }
            else{
                return redirect()->route('perfil')->with('error', 'Pedido sin metodo de pago');
            }
            return redirect()->route('pedidos.index')->with('success', 'Pedido realizado correctamente');
        } else
            return redirect()->route('perfil')->with('error', 'Pedido sin productos');
    }

    public function destroy($id)
    {
        return Pedido::destroy($id);
    }
}
