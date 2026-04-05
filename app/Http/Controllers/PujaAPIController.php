<?php

namespace App\Http\Controllers;

use App\Models\Puja;
use App\Models\Subasta;
use Illuminate\Http\Request;

class PujaAPIController extends Controller
{
    public function index()
    {
        return response()->json(Puja::all());
    }

    public function show($id)
    {
        $puja = Puja::findOrFail($id);
        return response()->json($puja);
    }

    public function indexBySubasta($id)
    {
        $puja = Puja::where('subasta_id', $id)->get();

        return response()->json($puja);
    }

    public function pujaBySubasta($id)
    {
        $puja = Puja::where('subasta_id', $id)
            ->orderBy('cantidad', 'desc')
            ->first();
        
        return response()->json($puja);
    }

    public function store(Request $request, int $id)
    {
        $pc = new PujaController();

        $request->validate([
            'subasta_id' => ['required', 'exists:subastas,id'],
        ]);

        $pujaMax = $pc->pujaBySubasta($request->subasta_id);
        $subasta = Subasta::findOrFail($request->subasta_id);

        $request->validate([
            'cantidad' => ['required', 'numeric', 'min:' . ($pujaMax ? $pujaMax['cantidad'] : $subasta->pInicial)],
        ]);

        $puja = Puja::create([
            'subasta_id' => $request->subasta_id,
            'cantidad' => $request->cantidad,
            'usuario_id' => $id,
            'hora' => now(),
        ]);

        return response()->json(['message' => 'Puja realizada correctamente', 'puja' => $puja]);
    }

    public function update(Request $request, $id)
    {
        $puja = Puja::findOrFail($id);
        $puja->update($request->all());
        return response()->json($puja);
    }

    public function destroy($id)
    {
        Puja::destroy($id);
        return response()->json(['message' => 'Puja eliminada correctamente']);
    }
}
