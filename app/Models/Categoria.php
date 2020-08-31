<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable = ['nome', 'sigla', 'descricao'];

    public function produtos(){
        return $this->belongsTo(Produto::class);
    }
}
