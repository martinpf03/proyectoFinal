<?php

namespace App\Http\Controllers;
use App\Models\Carrito;

class PerfilController extends Controller
{

    public function datosUsuario() {
        // Crear instancias de los controladores
        $productoController = new ProductoController();
        $subastaController = new SubastaController();
        $carritoController = new CarritoController();
    
        // Obtener datos llamando a métodos de instancias
        $productos = $productoController->indexByVendedor();
        $subastas = $subastaController->indexByVendedor();
    
        // Obtener el carrito correctamente
        $carrito = $carritoController->showByVendedor();

    
        return view('perfil', [
            'productos' => $productos, 
            'subastas' => $subastas, 
            'carrito' => $carrito
        ]);
    }
}
