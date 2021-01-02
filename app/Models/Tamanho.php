<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tamanho extends Model
{
    protected $fillable = ['nome', 'sigla', 'descricao', 'tipo'];

    public function estoque(){
        return $this->hasOne(TamanhoProduto::class);
    }

    public function tamanhoMasculino(){
        $tamanhoM = Tamanho::where('tipo', "M")->get();
    
        return $tamanhoM;
    }

    public function tamanhoFeminino(){
        $tamanhoF = Tamanho::where('tipo', "F")->get();
    
        return $tamanhoF;
    }

    public function tamanhoNumerico(){
        $tamanhoN = Tamanho::where('tipo', "N")->get();
    
        return $tamanhoN;
    }
}
