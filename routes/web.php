<?php

use App\Http\Controllers\CarritoController;
use App\Http\Controllers\PayPalController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\SubastaController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\PujaController;
use App\Http\Controllers\JuegoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/app/#');
})->name('inicio');

Route::get('/dashboard', function () {
    return redirect('/app/#');
})->name('inicio');

Route::get('language/{locale}', function ($locale) {

    app()->setLocale($locale);
    session()->put('locale', $locale);

    return redirect()->back()->cookie('idioma', $locale, 60*24*365);

})->name('idioma');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('producto/table', [ProductoController::class, 'table'])->name('productos.table');
    Route::get('productos/{id}', [ProductoController::class, 'show'])->name('productos.show');
    Route::get('producto/create', [ProductoController::class, 'create'])->name('productos.create');
    Route::post('producto', [ProductoController::class, 'store'])->name('productos.store');
    Route::get('producto/{id}', [ProductoController::class, 'edit'])->name('productos.edit');
    Route::put('producto/{id}', [ProductoController::class, 'update'])->name('productos.update');
    Route::post('producto/{id}', [ProductoController::class, 'destroy'])->name('productos.delete');

    Route::get('subasta/table', [SubastaController::class, 'table'])->name('subastas.table');
    Route::get('subastas/{id}', [SubastaController::class, 'show'])->name('subastas.show');
    Route::get('subasta/create', [SubastaController::class, 'create'])->name('subastas.create');
    Route::post('subasta', [SubastaController::class, 'store'])->name('subastas.store');
    Route::get('subasta/{id}', [SubastaController::class, 'edit'])->name('subastas.edit');
    Route::put('subasta/{id}', [SubastaController::class, 'update'])->name('subastas.update');
    Route::post('subasta/{id}', [SubastaController::class, 'destroy'])->name('subastas.delete');

    //Route::get('pedidos', [PedidoController::class, 'index'])->name('pedidos.index');
    Route::get('/pedidos', function () {
        return redirect('/app/#/pedidos');
    })->name('pedidos.index');
    Route::get('pedidos/show', [PedidoController::class, 'show'])->name('pedidos.show');
    Route::post('pedidos', [PedidoController::class, 'store'])->name('pedidos.store');

    Route::post('puja', [PujaController::class, 'store'])->name('puja.post');
    Route::post('carrito', [CarritoController::class, 'addProducto'])->name('carrito.add');
   Route::post('carrito/{id}/{precio}', [CarritoController::class, 'quitProducto'])
    ->name('carrito.del');

    Route::get('perfil', [PerfilController::class, 'datosUsuario'])->name('perfil');

    Route::get('/paypal/create', [PayPalController::class, 'create'])->name('paypal.create');
    Route::get('/paypal/success', [PayPalController::class, 'success'])->name('paypal.success');
    Route::get('/paypal/cancel', [PayPalController::class, 'cancel'])->name('paypal.cancel');
});

//Route::get('productos', [ProductoController::class, 'index'])->name('productos');
//Route::get('subastas', [SubastaController::class, 'index'])->name('subastas');
Route::get('juegos', [JuegoController::class, 'index'])->name('juegos');

require __DIR__ . '/auth.php';

Route::get('/app/{any?}', function () {
    return response()->file(public_path('app/index.html'));
})->where('any', '.*');