<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MateriaPrima extends Model
{
    use HasFactory;
    protected $fillable = 
        [   
            'tipo_produto_id', 'nome', 'sigla', "composicao", 'estoque_inicial', 'estoque_minimo', 'estoque_atual', 
            'estoque_real', 'estoque_reservado', 'preco_venda', 'preco_compra', 'custo_atual', 'marge_venda',
            'custo_producao',  'descricao', 'core_id', 'unidade_id', 'status_id'
        ];

    public function tipoProduto(){
        return $this->hasOne(TipoProduto::class, 'id','tipo_produto_id');
    }

    public function status(){
        return $this->hasOne(Status::class, 'id','status_id');
    }

    public function unidade(){
        return $this->hasOne(Unidade::class, 'id','unidade_id');
    }

    public function cor(){
        return $this->hasOne(Cores::class, 'id','core_id');
    }
}
