<?php

namespace App\Http\Controllers;
use App\Models\Carrito;


use App\Models\Pedido;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PayPalController extends Controller
{
    public function create(Request $request)
{
    $total = $request->total;

    $provider = new PayPalClient;
    $provider->setApiCredentials(config('paypal'));
    $provider->getAccessToken();

    $order = $provider->createOrder([
        "intent" => "CAPTURE",
        "purchase_units" => [
            [
                "amount" => [
                    "currency_code" => "EUR",
                    "value" => number_format($total, 2, '.', '')
                ]
            ]
        ],
        "application_context" => [
            "return_url" => route('paypal.success'),
            "cancel_url" => route('paypal.cancel'),
        ]
    ]);

    return redirect($order['links'][1]['href']);
}

    public function success(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();

        $carrito  = Carrito::where('usuario_id', Auth::id())->first();
        $productos = $carrito->productos; // Acceder a los productos del carrito

        $pedido = Pedido::create([
                    'usuario_id' => Auth::id(),
                    'metodoPago' => 'paypal',
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

        $response = $provider->capturePaymentOrder($request['token']);

        // se guarda el pedido como pagado
        return redirect('/pedidos');
    }

    public function cancel()
    {
        //se cancela el pedido
        return redirect('/perfil');
    }
}