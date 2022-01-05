<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servico extends Model
{
    use HasFactory;

    protected $table = 'servico';

    public function users(){
        return  $this->belongsTo('App\Models\User');
    }

    public function cliente(){
        return  $this->hasMany('App\Models\Cliente','servico_id','id');
    }

    public function compra(){
        return  $this->hasMany('App\Models\Compra','servico_id','id');
    }
    
    public function modelo(){
        return  $this->hasMany('App\Models\Modelo','servico_id','id');
    }

    public function produto(){
        return  $this->hasMany('App\Models\Produto','servico_id','id');
    }

    public function rastreamento(){
        return  $this->hasMany('App\Models\Rastreamento','servico_id','id');
    }

    public function remessa(){
        return  $this->hasMany('App\Models\Remessa','servico_id','id');
    }

    public function vendedor(){
        return  $this->hasMany('App\Models\Vendedor','servico_id','id');
    }

}
