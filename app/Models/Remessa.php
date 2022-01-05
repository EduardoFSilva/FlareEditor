<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Remessa extends Model
{
    use HasFactory;

    protected $table = 'remessa';

    public function servico(){
        return  $this->belongsTo('App\Models\Servico');
    }

    public function rastreamento(){
        return  $this->belongsTo('App\Models\Rastreamento');
    }
    public function compra(){
        return  $this->hasMany('App\Models\Compra','cliente_id','id');
    }
}
