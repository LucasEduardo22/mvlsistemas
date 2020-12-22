<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FichaTecnica extends Model
{

    protected $fillable = ['materia_prima_id', 'produto_id' ,'detalhes', "valor_custo", "quantidade", "observacao"];

    public function produtosMateriaPrima(){
        return $this->hasOne(MateriaPrima::class, 'id', 'materia_prima_id');
    }
    public function aviamentoProdutos(){
        return $this->hasMany(Produto::class);
    }
}
