<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Puja extends Model
{
    //
    protected $fillable = ['subasta_id','cantidad','usuario_id','hora'];

    public function user(){
        return $this->belongsTo(User::class,'usuario_id');
    }
    public function subasta(){
        return $this->belongsTo(Subasta::class,'subasta_id');
    }
}
