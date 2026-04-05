<?php

namespace App\Http\Controllers;

use App\Models\Subasta;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\Pieza;
use App\Models\Consola;
use App\Models\Arcade;


class SubastaController extends Controller
{
    public function index()
    {
        $productos = Subasta::all();
        return view('subastas.index', ['productos' => $productos]);
    }

    public function indexByVendedor()
    {
        $vendedorId = Auth::id();
        $subastasId = [];

        $consulta = DB::select("
            SELECT subastas.id FROM subastas
            INNER JOIN productos ON subastas.producto_id = productos.id
            INNER JOIN users ON productos.vendedor_id = users.id
            WHERE users.id = ?", [$vendedorId]);


        // Convertir el resultado en una colección de Laravel
        foreach ($consulta as $subasta) {
            array_push($subastasId, $subasta->id);
        }

        return Subasta::findMany($subastasId);
    }

    public function table()
    {
        $sc = new SubastaController();
        if (Auth::user()->role == "admin")
            $subastas = Subasta::all();
        else
            $subastas = $sc->indexByVendedor();

        return view('subastas.table', ['subastas' => $subastas]);
    }


    public function show($id)
    {
        $pj = new PujaController();
        $subasta = Subasta::find($id);

        if ($subasta) {

            $producto = $subasta->producto;

            $puja = $pj->pujaBySubasta($id);

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

            return view('subastas.show', ['subasta' => $subasta, 'subtipo' => $subtipo, 'puja' => $puja]);

        } else {
            $productos = Subasta::all();
            return redirect('/app/#/subastas');
        }
    }

    public function create()
    {
        //
        $productos = Producto::where('vendedor_id', Auth::id())->get();
        return view('subastas.create', ['productos' => $productos]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|integer|exists:App\Models\Producto,id',
            'pInicial' => 'required|numeric',
            'fechaInicio' => 'required|date',
            'fechaFin' => 'required|date',
        ]);

        Subasta::create($request->all());

        return redirect()->route('subastas.table')->with('success', 'Subasta creada correctamente');
    }

    public function edit(string $id)
    {
        //
        $subasta = Subasta::find($id);
        $productos = Producto::where('vendedor_id', $subasta->producto->vendedor_id)->get();

        return view(
            'subastas.edit',
            [
                'subasta' => $subasta,
                'productos' => $productos
            ]
        );
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'producto_id' => 'required|integer|exists:App\Models\Producto,id',
            'pInicial' => 'required|numeric',
            'fechaInicio' => 'required|date',
            'fechaFin' => 'required|date',
        ]);

        $subasta = Subasta::findOrFail($id);
        $subasta->update($request->all());
        return redirect()->route('subastas.table')->with('success', 'Subasta actualizada correctamente');
    }

    public function destroy($id)
    {
        Subasta::destroy($id);
        return  redirect()->route('subastas.table')->with('success', 'Subasta eliminada correctamente');
    }
}
