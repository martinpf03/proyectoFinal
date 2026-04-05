<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Pieza;
use App\Models\Consola;
use App\Models\Arcade;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductoAPIController extends Controller
{
    public function index()
    {
        return response()->json(Producto::all());
    }

    public function indexByVendedor($vendedor_id)
    {
        $productos = Producto::where('vendedor_id', $vendedor_id)->get();
        return response()->json($productos);
    }

    public function show($id)
    {
        $producto = Producto::findOrFail($id);

        if ($producto->tipo == "consola") {
            $subtipo = Consola::where('producto_id', $producto->id)->first();
        } elseif ($producto->tipo == "pieza") {
            $subtipo = Pieza::where('producto_id', $producto->id)->first();
        } else {
            $subtipo = Arcade::where('producto_id', $producto->id)->first();
        }

        return response()->json(["producto" => $producto, "subtipo" => $subtipo]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'stock' => 'required|integer|min:0',
            'precio' => 'required|numeric|min:0',
            'IVA' => 'required|numeric|min:0',
            'tipo' => 'required|string',
            'vendedor_id' => 'required|integer',
            'url_imagen' => 'required|string',
            //campos de subtipo
            'tipo' => 'string|in:arcade,pieza,consola',
            'anho_salida' => 'integer',
            'dimensiones' => 'string',
            'peso' => 'numeric',
            'garantia' => 'integer',
            'marca' => 'string',
            'portatil' => 'boolean',
        ]);

        $producto = Producto::create([
            'nombre' => $request->nombre,
            'url_imagen' => $request->url_imagen,
            'descripcion' => $request->descripcion,
            'stock' => $request->stock,
            'precio' => $request->precio,
            'IVA' => $request->IVA / 100,
            'tipo' => $request->tipo,
            'vendedor_id' => $request->vendedor_id,
        ]);

        if ($request->tipo == 'arcade') {
            $subtipo = Arcade::create(
                [
                    'anho_salida' => $request->anho_salida,
                    'marca' => $request->marca,
                    'producto_id' => $producto->id,
                ]
            );
        } else if ($request->tipo == 'pieza') {
            $subtipo = Pieza::create(
                [
                    'dimensiones' => $request->dimensiones,
                    'peso' => $request->peso,
                    'garantia' => $request->garantia,
                    'producto_id' => $producto->id,
                ]
            );
        } else {
            $subtipo = Consola::create(
                [
                    'marca' => $request->marca,
                    'portatil' => $request->portatil == 'on' ? 1 : 0,
                    'producto_id' => $producto->id,
                ]
            );
        }

        return response()->json([
            'message' => 'Producto creado correctamente',
            'producto' => $producto,
            'subtipo' => $subtipo
        ]);
    }

    public function update(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);

        $request->validate([
            'nombre' => 'string|max:255',
            'descripcion' => 'string',
            'stock' => 'integer|min:0',
            'precio' => 'numeric|min:0',
            'IVA' => 'numeric|min:0',
            'tipo' => 'string|in:arcade,pieza,consola',
        ]);

        $producto->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'stock' => $request->stock,
            'precio' => $request->precio,
            'IVA' => $request->IVA, 
        ]);

           

           if ($request->tipo == 'arcade') {
            $request->validate([
                'anho_salida' => 'required|integer',
                'marcaArcade' => 'required|string'
            ]);

            $this->eliminarSubtipo($producto);
        
            Arcade::create([
                'anho_salida' => $request->anho_salida,
                'marca' => $request->marcaArcade,
                'producto_id' => $producto->id,
            ]);

            $producto->update([
                'tipo' => 'arcade'
            ]);

        } else if ($request->tipo == 'pieza') {
            $request->validate([
                'dimensiones' => 'required|string',
                'peso' => 'required|numeric'
            ]);

            $this->eliminarSubtipo($producto);
        
            Pieza::create([
                'dimensiones' => $request->dimensiones,
                'peso' => $request->peso,
                'garantia' => $request->garantia,
                'producto_id' => $producto->id,
            ]);
            $producto->update([
                'tipo' => 'pieza'
            ]);
        } else {
            $request->validate([
                'marcaConsola' => 'required|string',
            ]);
        
            $this->eliminarSubtipo($producto);

            Consola::create([
                'marca' => $request->marcaConsola,
                'portatil' => $request->portatil == 'on' ? 1 : 0,
                'producto_id' => $producto->id,
            ]);
            $producto->update([
                'tipo' => 'consola'
            ]);
        }

        return response()->json(['message' => 'Producto actualizado correctamente', 'producto' => $producto]);
    }

    public function eliminarSubtipo($producto){

        if ($producto->tipo == 'consola') {
            $consola = Consola::where('producto_id', $producto->id)->first();
            Consola::destroy($consola->id);
        } else if ($producto->tipo == 'pieza') {
            $pieza = Pieza::where('producto_id', $producto->id)->first();
            Consola::destroy($pieza->id);
        } else {
            $arcade = Arcade::where('producto_id', $producto->id)->first();
            Arcade::destroy($arcade->id);
        }
    }

    public function destroy($id)
    {
        Producto::destroy($id);
        return response()->json(['message' => 'Producto eliminado correctamente']);
    }
}
