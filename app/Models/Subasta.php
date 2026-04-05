<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subasta extends Model
{
    /** @use HasFactory<\Database\Factories\SubastaFactory> */
    use HasFactory;
    protected $fillable = ['id', 'producto_id', 'pInicial', 'pFinal', 'fechaInicio', 'fechaFin'];


    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function pujas()
    {
        return $this->hasMany(Puja::class);
    }
}
