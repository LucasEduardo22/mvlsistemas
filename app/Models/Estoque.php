<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estoque extends Model
{
    protected $fillable = 
        [   
            'produto_id', 'estoque_inicial', 'estoque_minimo', 'estoque_atual', 
            'estoque_real', 'estoque_reservado', 'preco_venda', 'preco_compra', 'custo_atual', 
            'custo_producao', 'cor', 'unidade_id', 'status_id'
        ];

    public function tamanho(){
        return $this->hasMany(TamanhoProduto::class);
    }

    public function unidade(){
        return $this->belongsTo(Unidade::class);
    }

    public function produto(){
        return $this->belongsTo(Produto::class);
    }

    public function status(){
        return $this->belongsTo(Status::class);
    }
}
