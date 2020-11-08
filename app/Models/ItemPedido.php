<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemPedido extends Model
{
    protected $fillable = [
        'pedido_id', 'estoque_id', 'valor_unitario', 'valor_total', 
        'quantidade', "cor_principal", 'cor_secundaria', 'cor_terciaria',
        'frente', 'costa', 'manga_direita', 'manga_esquerda', 'tipo_tamano'
    ];

    
    public function tecidos(){
        return $this->belongsToMany(Tecido::class, "item_pedido_tecidos");
    }

    public function estoque(){
        return $this->belongsTo(Estoque::class);
    }

    public function tamanhosItensPedidos(){
        return $this->hasMany(tamanhoItensPedidos::class);
    }

    public function quantidade($id)
    {
        $tipoTamanho = ItemPedido::where('id', $id)->first();
        if($tipoTamanho->tipo_tamano == "N"){
            $quantidade = $tipoTamanho->quantidade;
        }else{
            $quantidade = $tipoTamanho->tamanhosItensPedidos->sum('quantidade');
        }

        return $quantidade;
    }

    public function valor($id)
    {
        $tipoTamanho = ItemPedido::where('id', $id)->first();
        if($tipoTamanho->tipo_tamano == "N"){
            $valor = $tipoTamanho->valor_unitario;
        }else{
            $valor = $tipoTamanho->tamanhosItensPedidos->sum('valor_unitario');
        }

        return $valor;
    }
}
