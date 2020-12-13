<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estoque extends Model
{
    protected $fillable = 
        [   
            'produto_id', 'estoque_inicial', 'estoque_minimo', 'estoque_atual', 
            'estoque_real', 'estoque_reservado', 'preco_venda', 'preco_compra', 'custo_atual', 
            'custo_producao', 'cor', 'unidade_id', 'status_id', "valor_tecido_principal", 'metro_kilo',
            "valor_tecido_secundario", "valor_tecido_terciario"
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

    public function mask($id, $valor_tecido) {
        $estoque = Estoque::where('id', $id)->first();

        if ($estoque->metro_kilo == "M") {
            return number_format($valor_tecido , 2, ',', '.');
        } elseif ($estoque->metro_kilo == "P") {
            return number_format($valor_tecido , 3, ',', '.');
        }
        
    }
}
