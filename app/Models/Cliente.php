<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'cliente';

    public function servico(){
        return  $this->belongsTo('App\Models\Servico');
    }

    public function compra(){
        return  $this->hasMany('App\Models\Compra','cliente_id','id');
    }

}
