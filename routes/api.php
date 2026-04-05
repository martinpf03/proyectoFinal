<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CarritoAPIController;
use App\Http\Controllers\ProductoAPIController;
use App\Http\Controllers\SubastaAPIController;
use App\Http\Controllers\PedidoAPIController;
use App\Http\Controllers\JuegoAPIController;
use App\Http\Controllers\PujaAPIController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('loginAPI',[LoginController::class,'loginAPI']);

Route::get('/carritos', [CarritoAPIController::class, 'index'])->middleware('auth:sanctum');
Route::get('/carrito/{id}', [CarritoAPIController::class, 'show'])->middleware('auth:sanctum');;
Route::post('/carrito/{id}', [CarritoAPIController::class, 'addProducto'])->middleware('auth:sanctum');;
Route::post('/carrito/delete/{id}', [CarritoAPIController::class, 'removeProducto'])->middleware('auth:sanctum');;

Route::get('/pedidos/{id}', [PedidoAPIController::class, 'index'])->middleware('auth:sanctum');;
Route::get('/pedido/{id}', [PedidoAPIController::class, 'show'])->middleware('auth:sanctum');;
Route::post('/pedidos/{id}', [PedidoAPIController::class, 'store'])->middleware('auth:sanctum');;


Route::get('/juegos', [JuegoAPIController::class, 'index']);


Route::get('/productos', [ProductoAPIController::class, 'index']);
Route::get('/productos/{id}', [ProductoAPIController::class, 'indexByVendedor'])->middleware('auth:sanctum');;
Route::get('/producto/{id}', [ProductoAPIController::class, 'show'])->middleware('auth:sanctum');;
Route::post('/productos', [ProductoAPIController::class, 'store'])->middleware('auth:sanctum');;
Route::put('/productos/{id}', [ProductoAPIController::class, 'update'])->middleware('auth:sanctum');;
Route::delete('/productos/{id}', [ProductoAPIController::class, 'destroy'])->middleware('auth:sanctum');;

Route::get('/pujas/{id}', [PujaAPIController::class, 'indexBySubasta'])->middleware('auth:sanctum');;
Route::get('/puja/{id}', [PujaAPIController::class, 'pujaBySubasta'])->middleware('auth:sanctum');;
Route::post('/pujas/{id}', [PujaAPIController::class, 'store'])->middleware('auth:sanctum');;



Route::get('/subastas', [SubastaAPIController::class, 'index']);
Route::get('/subastas/{id}', [SubastaAPIController::class, 'indexByVendedor'])->middleware('auth:sanctum');;
Route::get('/subasta/{id}', [SubastaAPIController::class, 'show'])->middleware('auth:sanctum');;
Route::post('/subastas', [SubastaAPIController::class, 'store'])->middleware('auth:sanctum');;
Route::put('/subastas/{id}', [SubastaAPIController::class, 'update'])->middleware('auth:sanctum');;
Route::delete('/subastas/{id}', [SubastaAPIController::class, 'destroy'])->middleware('auth:sanctum');;

