<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cidade extends Model
{
    public function bairro(){
        return $this->hasMany(Bairro::class);
    }

    public function estado(){
        return $this->hasOne(Estado::class);
    }
}
