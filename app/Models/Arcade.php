<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arcade extends Model
{
    /** @use HasFactory<\Database\Factories\ProductoFactory> */
    use HasFactory;
    protected $table = 'arcades';
    protected $fillable = ['anho_salida','marca','producto_id'];

    public function producto(){
        return $this-> belongsTo(Producto::class,'producto_id');
    }
   
}
