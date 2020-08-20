<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{

    public function bairro(){
        return $this->hasOne(Bairro::class);
    }
}
