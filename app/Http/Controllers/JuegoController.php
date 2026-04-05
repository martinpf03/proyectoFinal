<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;


class JuegoController extends Controller
{
    //
    public function index()
    {
        $apiUrl = "https://api.rawg.io/api/games?dates=1970-01-01,1999-12-31&ordering=released&key=663f801e3cae4e5c9f3233716c1bb282";
        $response = Http::get($apiUrl);
        $juegos = json_decode($response->body(), true);
    
        $juegosResultado = [];
    
        if (isset($juegos['results'])) {
            foreach ($juegos['results'] as $juego) {
                $juegosResultado[] = [
                    'titulo' => $juego['name'],
                    'genero' => $juego['genres'][0]['name'] ?? 'Desconocido',
                    'imagen' => $juego['short_screenshots'][0]['image'] ?? null,
                    'fecha_salida' => $juego['released'],
                ];
            }
        }
    
        return view('juegos',['juegos'=>$juegosResultado]);
    }

}
