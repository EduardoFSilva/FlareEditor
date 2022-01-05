<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendedor extends Model
{
    use HasFactory;

    protected $table = 'vendedor';

    public function servico(){
        return $this->belongsTo('App\Models\Servico');
    }

    public function produto(){
        return $this->hasMany('App\Models\Produto','vendedor_id','id');
    }

}
