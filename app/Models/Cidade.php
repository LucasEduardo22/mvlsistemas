<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cidade extends Model
{
    public function estado(){
        return $this->belongsTo(Estado::class);
    }

    public function bairros(){
        return $this->hasMany(Bairro::class, 'cidade_id', 'id');
    }
}
