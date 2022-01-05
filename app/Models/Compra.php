<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;

    protected $table = 'compra';

    public function servico(){
        return  $this->belongsTo('App\Models\Servico');
    }

    public function cliente(){
        return  $this->belongsTo('App\Models\Cliente');
    }

    public function remessa(){
        return  $this->belongsTo('App\Models\Remessa');
    }

    public function produto(){
        return  $this->belongsTo('App\Models\Produto');
    }

}
