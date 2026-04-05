<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarritoAPIController extends Controller
{
    public function index()
    {
        return response()->json(Carrito::all());
    }

    public function show($id)
    {
        $carrito = Carrito::where('usuario_id', $id)->first();
        return response()->json(['carrito'=>$carrito,'productos'=>$carrito->productos()->get()]);
    }

    public function addProducto(Request $request, int $id)
    {
        $carrito = Carrito::where('usuario_id', $id)->first();
        if (!$carrito) {
            $carrito = Carrito::create(['usuario_id' => $id]);
        }

        $producto = Producto::find($request->producto_id);
        if (!$producto) {
            return response()->json(['error' => 'Producto no encontrado'], 404);
        }

        $carrito->productos()->attach($producto->id, ['cantidad' => $request->cantidad]);
        return response()->json(['message' => 'Producto agregado al carrito'],200);
    }

    public function removeProducto(Request $request, $id)
    {
        $carrito = Carrito::where('usuario_id', $id)->first();
        if (!$carrito) {
            return response()->json(['error' => 'Carrito no encontrado'], 404);
        }

        $producto = Producto::find($request->producto_id);
        if (!$producto) {
            return response()->json(['error' => 'Producto no encontrado'], 404);
        }

        $carrito->productos()->detach($producto->id);
        return response()->json(['message' => 'Producto eliminado del carrito'],200);
    }
}
