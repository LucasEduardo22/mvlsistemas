<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bairro extends Model
{
    public function endereco(){
        return $this->hasMany(Endereco::class);
    }

    public function cidade(){
        return $this->hasOne(Cidade::class);
    }
}
