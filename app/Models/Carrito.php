<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    /** @use HasFactory<\Database\Factories\CarritoFactory> */
    use HasFactory;

    protected $table = 'carritos';
    protected $fillable = ['usuario_id'];

    public function user(){
        return $this-> belongsTo(User::class,'usuario_id');
     }
    public function productos(){
        return $this-> belongsToMany(Producto::class)
        ->withPivot('cantidad')
        ->withPivot('precio_carrito');
    }
}
