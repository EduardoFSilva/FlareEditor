<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rastreamento extends Model
{
    use HasFactory;

    protected $table = 'rastreamento';

    public function servico(){
        return  $this->belongsTo('App\Models\Servico');
    }
    public function remessa(){
        return $this->hasMany("App\Models\Remessa","rastreamento_id","id");
    }

}
