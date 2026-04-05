<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CarritoController extends Controller
{
    public function index()
    {
        return Carrito::all();
    }

    public function showByVendedor()
    {
        $carrito = Carrito::where('usuario_id', Auth::id())->first();
        if (!$carrito) {
            $carrito = Carrito::create(
                [
                    'usuario_id' => Auth::id()
                ]
            );
        }
        return $carrito;
    }

    public function addProducto(Request $request)
    {

        $cc = new CarritoController();
        $producto = Producto::findOrFail($request->id);
        $carrito = $cc->showByVendedor();


        $request->validate([
            'id' => 'required|integer',
            'cantidad' => 'required|integer|max:' . $producto->stock,
            'precio_carrito' => 'required|numeric',
        ]);

        //Se comprueba si el producto ya esta en el carrito, si está, en vez de meterlo otra vez, se añade la cantidad de ese producto
        foreach ($cc->showByVendedor()->productos as $producto) {
            if ($producto->id == $request->id && $producto->pivot->precio_carrito == $request->precio_carrito) {
                $carrito->productos()
                    ->where('producto_id', $request->id)
                    ->wherePivot('precio_carrito', $request->precio_carrito)
                    ->update([
                        'cantidad' => DB::raw('cantidad + ' . $request->cantidad)
                    ]);
                $producto->bajarStock($request->cantidad);
                return redirect()->route('perfil')->with('success', 'Producto añadido al carrito');
            }
        }


        $producto = Producto::findOrFail($request->id);

        $cc->showByVendedor()->productos()->attach($producto, ['cantidad' => $request->cantidad, 'precio_carrito' => $request->precio_carrito]);

        $producto->bajarStock($request->cantidad);

        return redirect()->route('perfil')->with('success', 'Producto añadido al carrito');
    }

    public function quitProducto($id, $precio)
    {
        $cc = new CarritoController();
        $producto = Producto::findOrFail($id);
        //Se comprueba tanto el id como el precio en el carrito, para evitar que pulsando un eliminar de un producto, se eliminen
        //los demás productos del mismo tipo pero con distinto precio

        foreach ($cc->showByVendedor()->productos as $prod) {
            if ($prod->id == $id && $prod->pivot->precio_carrito == $precio) {
                $producto->subirStock($prod->pivot->cantidad);
            }
        }
        //Se elimina unicamente el que tenga el mismo precio en el carrito
        $cc->showByVendedor()->productos()
            ->wherePivot('precio_carrito', $precio)
            ->detach($id);

        return redirect()->route('perfil')->with('success', 'Producto eliminado  del carrito');
    }


    public function show($id)
    {
        return Carrito::findOrFail($id);
    }

    public function store(Request $request)
    {
        return Carrito::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $carrito = Carrito::findOrFail($id);
        $carrito->update($request->all());
        return $carrito;
    }

    public function destroy($id)
    {
        return Carrito::destroy($id);
    }
}
