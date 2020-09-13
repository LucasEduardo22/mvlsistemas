<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bairro extends Model
{
    public function cidade(){
        return $this->belongsTo(Cidade::class);
    }

    public function enderecos(){
        return $this->hasMany(Endereco::class, 'bairro_id', 'id');
    }
}
