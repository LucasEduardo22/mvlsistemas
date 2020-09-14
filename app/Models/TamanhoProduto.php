<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TamanhoProduto extends Model
{
    public function tamanhoProduto(){

        //dd($this->hasOne(Tamanho::class));
        return $this->hasMany(Tamanho::class);
    }
}
