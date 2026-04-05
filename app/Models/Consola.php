<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consola extends Model
{
    /** @use HasFactory<\Database\Factories\ProductoFactory> */
    use HasFactory;
    protected $table = 'consolas';
    protected $fillable = ['marca','portatil','producto_id'];

    public function producto(){
        return $this-> belongsTo(Producto::class,'producto_id');
    }
   
}
