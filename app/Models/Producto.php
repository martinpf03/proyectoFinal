<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    /** @use HasFactory<\Database\Factories\ProductoFactory> */
    use HasFactory;

    protected $fillable = ['nombre','url_imagen','stock','descripcion','precio','IVA','tipo','vendedor_id'];

    public function vendedor(){
        return $this-> belongsTo(User::class,'vendedor_id');
    }
    public function pedidos(){
        return $this-> belongsToMany(Pedido::class)
        ->withPivot('cantidad')
        ->withPivot('precioVenta')
        ->withPivot('IVA_venta')
        ;
     }
     public function carritos(){
        return $this-> belongsToMany(Carrito::class)
        ->withPivot('cantidad');
    }

    public function bajarStock(int $cantidad){
        $nuevoStock = $this->stock - $cantidad;

        $this->update([
            'stock' => $nuevoStock
        ]);
    }

    public function subirStock(int $cantidad){
        $nuevoStock = $this->stock + $cantidad;

        $this->update([
            'stock' => $nuevoStock
        ]);
    }
}
