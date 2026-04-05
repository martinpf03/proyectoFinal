<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pieza extends Model
{
    /** @use HasFactory<\Database\Factories\ProductoFactory> */
    use HasFactory;
    protected $table = 'piezas';
    protected $fillable = ['dimensiones','peso','producto_id','garantia'];

    public function producto(){
        return $this-> belongsTo(Producto::class,'producto_id');
    }
   
}
