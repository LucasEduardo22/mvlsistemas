<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoProduto extends Model
{
    protected $fillable = ['nome', 'sigla', 'descricao'];

    public function produtos(){
        return $this->belongsTo(Produto::class);
    }
}
