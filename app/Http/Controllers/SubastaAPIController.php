<?php

namespace App\Http\Controllers;

use App\Models\Subasta;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class SubastaAPIController extends Controller
{
    public function index()
    {
        return response()->json(Subasta::all());
    }

    public function indexByVendedor($vendedorId)
    {
        $subastasId = [];

        $consulta = DB::select("SELECT subastas.id FROM subastas INNER JOIN productos ON subastas.producto_id = productos.id WHERE productos.vendedor_id = ?", [$vendedorId]);
    
        foreach ($consulta as $subasta) {
            array_push($subastasId, $subasta->id);
        }

        return response()->json(Subasta::findMany($subastasId));
    }
    
    public function show($id)
    {
        $subasta = Subasta::findOrFail($id);
        return response()->json(['subasta' => $subasta]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|integer|exists:productos,id',
            'pInicial' => 'required|numeric',
            'fechaInicio' => 'required|date',
            'fechaFin' => 'required|date',
        ]);

        $subasta = Subasta::create($request->all());
        return response()->json(['message' => 'Subasta creada correctamente', 'subasta' => $subasta]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'producto_id' => 'required|integer|exists:productos,id',
            'pInicial' => 'required|numeric',
            'fechaInicio' => 'required|date',
            'fechaFin' => 'required|date',
        ]);

        $subasta = Subasta::findOrFail($id);
        $subasta->update($request->all());
        return response()->json(['message' => 'Subasta actualizada correctamente', 'subasta' => $subasta]);
    }

    public function destroy($id)
    {
        Subasta::destroy($id);
        return response()->json(['message' => 'Subasta eliminada correctamente']);
    }
}
