<?php

namespace App\Http\Controllers;

use App\Models\Puja;
use App\Models\Subasta;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

class PujaController extends Controller
{
    public function index()
    {
        return Puja::all();
    }

    public function show($id)
    {
        return Puja::findOrFail($id);
    }

    public function pujaBySubasta($id)
    {
        return Puja::where('subasta_id', $id)
            ->orderBy('cantidad', 'desc')
            ->first();
    }


    public function store(Request $request)
    {
        $pjc = new PujaController();

        $request->validate([
            'subasta_id' => ['required', 'exists:subastas,id'],
        ]);

        $pujaMax = $pjc->pujaBySubasta($request->subasta_id);
        $subasta = Subasta::findOrFail($request->subasta_id);

        $request->validate([
            'cantidad' => ['required', 'numeric', 'min:' . ($pujaMax != null ? $pujaMax->cantidad : $subasta->pInicial)],
        ]);


        Puja::create(
            [
                'subasta_id' => $request->subasta_id,
                'cantidad' => $request->cantidad,
                'usuario_id' => Auth::user()->id,
                'hora' => now(),
            ]
        );

        return redirect()->route('subastas.show', ['id' => $request->subasta_id])->with('success', 'Puja realizada correctamente');
    }

}
