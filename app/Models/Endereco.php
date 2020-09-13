<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    public function bairro(){
        return $this->belongsTo(Bairro::class);
    }
}
