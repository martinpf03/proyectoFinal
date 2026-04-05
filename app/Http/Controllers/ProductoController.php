<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Pieza;
use App\Models\Consola;
use App\Models\Arcade;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::all();
        return view('productos.index', ['productos' => $productos]);
    }

    public function indexByVendedor()
    {
        $productos = Producto::where('vendedor_id', Auth::id())->get();

        return $productos;
    }

    public function table()
    {
        if (Auth::user()->role == "admin")
            $productos = Producto::all();
        else
            $productos = Producto::where('vendedor_id', Auth::id())->get();

        return view('productos.table', ['productos' => $productos]);
    }


    public function show($id)
    {
        $producto = Producto::findOrFail($id);

        if ($producto->tipo == "consola") {
            $id = DB::select("SELECT id FROM consolas where producto_id = ?", [$producto->id]);
            $subtipo = Consola::find($id[0]->id);
        } else if ($producto->tipo == "pieza") {
            $id = DB::select("SELECT id FROM piezas where producto_id = ?", [$producto->id]);
            $subtipo = Pieza::find($id[0]->id);
        } else {
            $id = DB::select("SELECT id FROM arcades where producto_id = ?", [$producto->id]);
            $subtipo = Arcade::find($id[0]->id);
        }



        return view('productos.show', ["producto" => $producto, "subtipo" => $subtipo]);
    }

    public function create()
    {
        //
        $usuarios = User::all();
        return view('productos.create', ['usuarios' => $usuarios]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'url_imagen' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'descripcion' => 'required|string',
            'stock' => 'required|integer|min:0',
            'precio' => 'required|numeric|min:0',
            'IVA' => 'required|numeric|min:0',
            'tipo' => 'required|string',
        ]);

        if ($request->hasFile('url_imagen')) {
            $image = $request->file('url_imagen');
            $imageName = 'media/img/' . $request->nombre . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('media/img'), $imageName);
        } else {
            $imageName = null;
        }

        $producto = Producto::create([
            'nombre' => $request->nombre,
            'url_imagen' => $imageName,
            'descripcion' => $request->descripcion,
            'stock' => $request->stock,
            'precio' => $request->precio,
            'IVA' => $request->IVA / 100,
            'tipo' => $request->tipo,
            'vendedor_id' => Auth::user()->id,
        ]);

        if ($request->tipo == 'arcade') {
            $request->validate([
                'anho_salida' => 'required|integer',
                'marcaArcade' => 'required|string'
            ]);
        
            Arcade::create([
                'anho_salida' => $request->anho_salida,
                'marca' => $request->marcaArcade,
                'producto_id' => $producto->id,
            ]);
        } else if ($request->tipo == 'pieza') {
            $request->validate([
                'dimensiones' => 'required|string',
                'peso' => 'required|numeric'
            ]);
        
            Pieza::create([
                'dimensiones' => $request->dimensiones,
                'peso' => $request->peso,
                'garantia' => $request->garantia,
                'producto_id' => $producto->id,
            ]);
        } else {
            $request->validate([
                'marcaConsola' => 'required|string',
            ]);
        
            Consola::create([
                'marca' => $request->marcaConsola,
                'portatil' => $request->portatil == 'on' ? 1 : 0,
                'producto_id' => $producto->id,
            ]);
        }

        return redirect()->route('productos.table')->with('success', 'Producto creado correctamente');
    }

    public function edit(string $id)
    {
        //
        $producto = Producto::find($id);

        if ($producto->tipo == 'consola') {
            $subtipo = Consola::where('producto_id', $producto->id)->first();
        } elseif ($producto->tipo == 'arcade') {
            $subtipo = Arcade::where('producto_id', $producto->id)->first();
        } elseif ($producto->tipo == 'pieza') {
            $subtipo = Pieza::where('producto_id', $producto->id)->first();
        }


        return view(
            'productos.edit',
            [
                'producto' => $producto,
                'subtipo' => $subtipo
            ]
        );
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

        return redirect()->route('productos.table')->with('success', 'Producto actualizado correctamente');
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

        return redirect()->route('productos.table')->with('success', 'Producto eliminado correctamente');
    }
}
