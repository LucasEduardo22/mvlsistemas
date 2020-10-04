<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tamanho extends Model
{
    protected $fillable = ['nome', 'sigla', 'descricao', 'tipo'];

    public function estoque(){
        return $this->hasOne(TamanhoProduto::class);
    }
}
