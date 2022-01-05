<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $table = 'produto';

    public function servico(){
        return  $this->belongsTo('App\Models\Servico');
    }
    public function vendedor(){
        return  $this->belongsTo('App\Models\Vendedor');
    }
    public function compra(){
        return  $this->hasMany('App\Models\Compra',"produto_id","id");
    }
}
