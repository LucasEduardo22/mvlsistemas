<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TamanhoProduto extends Model
{
    public function tamanhoProdutos(){

        return $this->hasOne(Tamanho::class, 'id', 'tamanho_id');
    }
}
